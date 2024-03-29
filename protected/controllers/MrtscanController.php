<?php

class MrtscanController extends Controller
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
		$model=new Mrtscan;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mrtscan']))
		{
			$model->attributes=$_POST['Mrtscan'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Mrtscan']))
		{
			$model->attributes=$_POST['Mrtscan'];
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
			$this->loadModel($id)->delete();

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
		$dataProvider=new CActiveDataProvider('Mrtscan', array(
            'criteria'=>array(
                'condition'=>'t.status='.Mrtscan::STATUS_ENABLED,
                'order'=>'name',
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
		$model=new Mrtscan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mrtscan']))
			$model->attributes=$_GET['Mrtscan'];

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
		$model=Mrtscan::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='mrtscan-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
	 * Manages all models via Ajax.
	 */
	public function _getGridViewMrtscanGrid()
	{
		$model=new Mrtscan('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Mrtscan']))
			$model->attributes=$_GET['Mrtscan'];

		$this->renderPartial('_gridview',array(
			'model'=>$model,
		));
	}
    
    /**
	 * Lists all models via Ajax.
	 */
	public function _getGridViewMrtscansList()
	{
		$dataProvider=new CActiveDataProvider('Mrtscan', array(
            'criteria'=>array(
                'condition'=>'t.status='.Mrtscan::STATUS_ENABLED,
                'order'=>'name',
            )
        ));
		$this->renderPartial('_listview',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
    /**
     * Return mrtscan price
     * @param integer the ID of the model to be loaded
     */
    public function actionGetPrice()
    {
        $id = 0;

        if (isset($_POST['Registration']['mrtscan_id']) )
            $id = $_POST['Registration']['mrtscan_id'];

        $model = Mrtscan::model()->findByPk($id);

        if($model===null)
        {
            echo CJSON::encode( array(
                'status' => 'failure',
                'content' => 0,
            ));
        }
        else
        {
            echo CJSON::encode( array(
                'status' => 'success',
                'content' => $model->price,
        ));

        }
        Yii::app()->end();

    }
}
