<?php

class ConclusionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

    /**
     * @var private property containing the associated Patient model instance.
     */
    private $_registration = null;
    
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
            'registrationContext + create',
            array( 
                'application.filters.GridViewHandler',
            ),
		));
	}
    
    /**
     * In-class defined filter method, configured for use in the above filters() method
     * It is called before the actionCreate() action method is run in order to ensure a proper patient context
     */

    public function filterRegistrationContext($filterChain)
    {
        //set the project identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions

        $registrationId = null;
        if(isset($_GET['rid']))
            $registrationId = $_GET['rid'];
        else if (isset($_POST['rid']))
            $registrationId = $_POST['rid'];

        $this->loadRegistration($registrationId);

        // complete the running of other filters and execute the requested action
        $filterChain->run();
    }
    
    /**
    * Protected method to load the associated Patient model class
    * @patient_id the primary identifier of the associated Patient
    * @return object the Project data model based on the primary key
    */
    protected function loadRegistration($registrationId)
    {
        //if the project property is null, create it based on input id
        if($this->_registration === null)
        {
            $this->_registration = Registration::model()->findbyPk($registrationId);
            if($this->_registration === null)
            {
                throw new CHttpException(404,'Область исследования не указан.');
            }
        }
        return $this->_registration;
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Conclusion;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Conclusion']))
		{
			$model->attributes=$_POST['Conclusion'];
            $model->registration_id = $this->_registration->id;
            
            $model->conclusion = CUploadedFile::getInstance($model, 'conclusion');
            if ($model->conclusion !== null  && 
                    $model->validate(array('conclusion')))
            {
                $file_path = $model->getUploadFilePath($model->registration->patient_id);
                
                // проверка на существования директории пациента
                if (!file_exists($file_path))
                {
                    mkdir ($file_path);
                }
                
                $name = uniqid().'.'.$model->conclusion->extensionName;
                
                $model->conclusion->saveAs($file_path.DIRECTORY_SEPARATOR.$name);
                $model->file = $name;
                
                if($model->save())
                {
                    if (!empty($_GET['asDialog']))
                    {
                        //Close the dialog, reset the iframe and update the grid
//                        echo CHtml::script("window.parent.$('#new-doctor-dialog').dialog('close');window.parent.$('#new-doctor-frame').attr('src','');;");
                        echo 'Загружено.';
                        Yii::app()->end();
                    }
                    else
                    {
                        $this->redirect(array('view','id'=>$model->id));
                    }
                }
            }
		}

		if (!empty($_GET['asDialog']))
        {
            $this->layout = '//layouts/iframe';
            $this->render('_form', array(
                'model'=>$model,
                'mrtscan_name'=>$this->_registration->mrtscan->name,
            ));
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
                'mrtscan_name'=>$this->_registration->mrtscan->name,
            ));
        }
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
//	public function actionUpdate($id)
//	{
//		$model=$this->loadModel($id);
//
//		// Uncomment the following line if AJAX validation is needed
//		// $this->performAjaxValidation($model);
//
//		if(isset($_POST['Conclusion']))
//		{
//			$model->attributes=$_POST['Conclusion'];
//			if($model->save())
//				$this->redirect(array('view','id'=>$model->id));
//		}
//
//		$this->render('update',array(
//			'model'=>$model,
//		));
//	}

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
            
//            $params = array("owner"=>$model->owner_id);
//            
//            if (!Yii::app()->user->checkAccess('deleteOwnConclusion',$params))
//            {
//                throw  new CHttpException(403, 'У вас недостаточно прав для выполнения указанного действия.');
//            }
   
            $file_path = $model->getUploadFilePath($model->registration->patient_id).DIRECTORY_SEPARATOR.$model->file;

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
		$dataProvider=new CActiveDataProvider('Conclusion');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Conclusion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Conclusion']))
			$model->attributes=$_GET['Conclusion'];

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
		$model=Conclusion::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='conclusion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    public function _getGridViewConclusionGrid()
    {
        $model=new Conclusion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Conclusion']))
			$model->attributes=$_GET['Conclusion'];

		$this->renderPartial('_gridview',array(
			'model'=>$model,
		));
    }
}
