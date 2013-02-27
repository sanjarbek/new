<?php

class TemplateController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
            array( 
                'application.filters.GridViewHandler', 
            ),
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
        $model = $this->loadModel($id);
        $params['owner'] = $model->owner_id;
        if (!Yii::app()->user->checkAccess('updateOwnTemplate', $params))
        {
            throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
        }
        
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Template('upload');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Template']))
		{
			$model->attributes=$_POST['Template'];
            $model->template = CUploadedFile::getInstance($model, 'template');
            if ($model->template !== null  && 
                    $model->validate(array('template')))
            {
                $file_path = $model->uploadFilePath;
                
                // проверка на существования пользователькой директории
                if (!file_exists($file_path))
                {
                    mkdir ($file_path);
                }
                
                $name = uniqid().'.'.$model->template->extensionName;
                
                $model->template->saveAs($file_path.DIRECTORY_SEPARATOR.$name);
                $model->file = $name;
                if($model->save())
                    $this->redirect(array('view','id'=>$model->id));
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

        $params['owner'] = $model->owner_id;
        if (!Yii::app()->user->checkAccess('updateOwnTemplate', $params))
        {
            throw new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
        }
                
                
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Template']))
		{
			$model->attributes=$_POST['Template'];
            $model->template = CUploadedFile::getInstance($model, 'template');
            if ($model->template !== null  && 
                    $model->validate(array('template')))
            {
                $file_path = $model->uploadFilePath;
                
                // проверка на существования пользователькой директории
                if (!file_exists($file_path))
                {
                    mkdir ($file_path);
                }
                
                $name = uniqid().'.'.$model->template->extensionName;
                
                $model->template->saveAs($file_path.DIRECTORY_SEPARATOR.$name);
                
                if (file_exists($file_path.DIRECTORY_SEPARATOR.$model->file))
                {
                    // delete old file
                    unlink ($file_path.DIRECTORY_SEPARATOR.$model->file);
                }
                // set new file name
                $model->file = $name;
            }
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel($id);
            
            $params = array("owner"=>$model->owner_id);
            
            if (!Yii::app()->user->checkAccess('deleteOwnTemplate',$params))
            {
                throw  new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
            }
   
            $file_path = $model->uploadFilePath.DIRECTORY_SEPARATOR.$model->file;

            if(file_exists($file_path))
                unlink($file_path);
            $model->delete();



            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));    
      
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider(
            Yii::app()->user->checkAccess('Admin') ?
                'Template' : Template::model()->my(), array(
            'criteria'=>array(
                'with'=>array('owner'),
            )
        ));
        
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Template('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Template']))
			$model->attributes=$_GET['Template'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Template::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='template-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function _getGridViewTemplateGrid()
    {
        $model=new Template('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Template']))
			$model->attributes=$_GET['Template'];

		$this->renderPartial('_gridview',array(
			'model'=>$model,
		));
    }
    
    public function _getGridViewTemplateList()
    {
        $dataProvider=new CActiveDataProvider(
            Yii::app()->user->checkAccess('Admin') ?
                'Template' : Template::model()->my(), array(
            'criteria'=>array(
                'with'=>array('owner'),
            )
        ));
        
		$this->renderPartial('_listview',array(
			'dataProvider'=>$dataProvider,
		));
    }

}
