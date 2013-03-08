<?php

class DoctorController extends Controller
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
		$model=new Doctor;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Doctor']))
		{
			$model->attributes=$_POST['Doctor'];
			if($model->save())
            {
                if (!empty($_GET['asDialog']))
                {
                    //Close the dialog, reset the iframe and update the grid
                    echo CHtml::script("window.parent.$('#new-doctor-dialog').dialog('close');window.parent.$('#new-doctor-frame').attr('src','');;");
                    Yii::app()->end();
                }
                else
                {
                    $this->redirect(array('view','id'=>$model->id));
                }
            }
		}
        
        if (!empty($_GET['asDialog']))
        {
            $this->layout = '//layouts/iframe';
            $this->render('_form', array(
                'model'=>$model,
            ));
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
            ));
        }
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

		if(isset($_POST['Doctor']))
		{
			$model->attributes=$_POST['Doctor'];
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
		$dataProvider=new CActiveDataProvider('Doctor', array(
            'criteria'=>array(
                'condition'=>'t.status='.Doctor::STATUS_ENABLED,
                'order'=>'hospital_id, type, t.fullname',
                'with'=>array('hospital'),
            ),
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
		$model=new Doctor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Doctor']))
			$model->attributes=$_GET['Doctor'];

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
		$model=Doctor::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='doctor-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    /**
	 * Manages all models via Ajax.
	 */
	public function _getGridViewDoctorGrid()
	{
		$model=new Doctor('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Doctor']))
			$model->attributes=$_GET['Doctor'];

		$this->renderPartial('_gridview',array(
			'model'=>$model,
		));
	}
    
    /**
	 * Lists all models via Ajax.
	 */
	public function _getGridViewDoctorsList()
	{
		$dataProvider=new CActiveDataProvider('Doctor', array(
            'criteria'=>array(
                'condition'=>'t.status='.Doctor::STATUS_ENABLED,
                'order'=>'hospital_id, type, fullname',
                'with'=>array('hospital'),
            ),
        ));
        
		$this->renderPartial('_listview',array(
			'dataProvider'=>$dataProvider,
		));
	}
    
    public function actionGetPatientDoctorInfo()
    {
        $doctor = $this->loadModel($_GET['did']);
        
        $this->layout = '//layouts/iframe';
        
        $this->render('patientdoctorinfo',array(
			'model'=>$doctor,
		));
    }
    
    public function actionGetHospitalsListJson()
    {
        $listData = Doctor::model()->getHospitalsList();
        
        $content = '';
        foreach ($listData as $key => $value)
                $content = $content . CHtml::tag('option',
                       array('value'=>$key),CHtml::encode($value),true);
        
        echo CJSON::encode(array(
                        'status'=>'success',
                        'content'=>$content,
        ));

        Yii::app()->end();
    }
    public function actionGetHospitalDoctorsList()
    {
        $hospital = 0;
        if (isset($_POST['hospital']))
            $hospital = (int)$_POST['hospital'];
        
        $doctors = array();
        if ($hospital != 0)
        {
            $doctors = Doctor::model()->findAll(
                'hospital_id=:hospitalId',
                array(':hospitalId'=>$hospital)
            );
        }
        
        echo CHtml::tag('option',
                array('value'=>'0'),CHtml::encode('Все'),true);
        foreach ($doctors as $doctor)
            echo CHtml::tag('option',
                array('value'=>$doctor->id),CHtml::encode($doctor->fullname),true);
        
        Yii::app()->end();
    }
    
}
