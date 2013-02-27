<?php

class RegistrationController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    
    /**
     * @var private property containing the associated Patient model instance.
     */
    private $_patient = null;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
        return CMap::mergeArray(parent::filters(),array(
            'patientContext + create 
                patient 
                update 
                getPatientRegistrations 
                getMrtscansList
                addService', //check to ensure valid patient context
//            'postOnly + delete', // we only allow deletion via POST request
            array(
                'application.filters.GridViewHandler' //path to GridViewHandler.php class
            )
        ));
	}
    
    /**
     * In-class defined filter method, configured for use in the above filters() method
     * It is called before the actionCreate() action method is run in order to ensure a proper patient context
     */

    public function filterPatientContext($filterChain)
    {
        //set the project identifier based on either the GET or POST input
        //request variables, since we allow both types for our actions

        $patientId = null;
        if(isset($_GET['pid']))
            $patientId = $_GET['pid'];
        else if (isset($_POST['pid']))
            $patientId = $_POST['pid'];

        $this->loadPatient($patientId);

        // complete the running of other filters and execute the requested action
        $filterChain->run();
    }
    
    /**
    * Protected method to load the associated Patient model class
    * @patient_id the primary identifier of the associated Patient
    * @return object the Project data model based on the primary key
    */
    protected function loadPatient($patient_id)
    {
        //if the project property is null, create it based on input id
        if($this->_patient===null)
        {
            $this->_patient=Patient::model()->findbyPk($patient_id);
            if($this->_patient===null)
            {
                throw new CHttpException(404,'The requested patient does not exist.');
            }
        }
        return $this->_patient;
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
		$model=new Registration;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Registration']))
		{
			$model->attributes=$_POST['Registration'];
            $model->patient_id = $this->_patient->id;
			if($model->save())
            {
                if (!empty($_GET['asDialog']))
                {
                    //Close the dialog, reset the iframe and update the grid
                    echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');
                        window.parent.$('#cru-frame').attr('src','');
                        window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');
                        alert('Saved');");
                    Yii::app()->end();
                }
                else
                    $this->redirect(array('view','id'=>$model->id));
            }
		}
        
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';
        
        $this->render('create',array(
            'model'=>$model,
            'patient'=>$this->_patient,
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

		if(isset($_POST['Registration']))
		{
			$model->attributes=$_POST['Registration'];
			if($model->save())
            {
                if (!empty($_GET['asDialog']))
                {
                    //Close the dialog, reset the iframe and update the grid
                    echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                    Yii::app()->end();
                }
                else
                    $this->redirect(array('view','id'=>$model->id));
            }
		}
        
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';

		$this->render('update',array(
			'model'=>$model,
            'patient'=>$this->_patient,
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
		$dataProvider=new CActiveDataProvider('Registration', array(
            'criteria'=>array(
                'with'=>array('patient', 'mrtscan'),
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
		$model=new Registration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

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
		$model=Registration::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
	 * Manages all models via Ajax.
	 */
	public function _getGridViewRegistrationGrid()
	{
		$model=new Registration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

		$this->renderPartial('_gridview',array(
			'model'=>$model,
		));
	}
    
    /**
     * The specified patient registrations only
     */
    public function _getGridViewPatientRegistrationGrid()
    {
        $model=new Registration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

        $model->patient_id = $this->_patient->id;
        
        $this->renderPartial('_gridviewpatientsregistrations', array(
            'model'=>$model,
            'patient'=>$this->_patient,
        ));
    }
    
    public function _getGridViewPatientMrtscanGrid()
    {
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';
        
        $criteria = Registration::model()->getNotYetSelectedCriteria($this->_patient);
        
        $dataProvider=new CActiveDataProvider('Mrtscan', array(
            'criteria'=>$criteria,
        ));
		$this->render('mrtscansdetail',array(
			'dataProvider'=>$dataProvider,
            'patientId'=>$this->_patient->id,
		));
    }
    
    /**
     * Patient registrations
     */
    public function actionPatientRegistrations()
    {
        $this->renderPartial('_gridviewpatientsregistrations', array(
            'patient_id'=>$this->_patient->id,
        ));
    }
    
    public function actionPatient()
    {
        $model=new Registration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

        $model->patient_id = $this->_patient->id;
        
        $this->render('patientdetails', array(
            'model'=>$model,
            'patient'=>$this->_patient,
        ));
    }
    
    public function actionGetMrtscansList()
    {
        if (!empty($_GET['asDialog']))
            $this->layout = '//layouts/iframe';
        
        $criteria = Registration::model()->getNotYetSelectedCriteria($this->_patient);
        
        $dataProvider=new CActiveDataProvider('Mrtscan', array(
            'criteria'=>$criteria,
        ));
		$this->render('mrtscansdetail',array(
			'dataProvider'=>$dataProvider,
            'patientId'=>$this->_patient->id,
		));
    }
    
    public function actionAddService()
    {
        
        if (!empty($_GET['asDialog']))
        {
            $mrtscan = Mrtscan::model()->findByPk($_GET['id']);
            
            $registration = new Registration;
            $registration->patient_id = $this->_patient->id;
            $registration->mrtscan_id = $mrtscan->id;
            $registration->price = $mrtscan->price;
            $registration->discont = 0.0;
            $registration->price_with_discont = $registration->price - $registration->discont;
            $registration->status = Registration::STATUS_NOT_YET_STARTED;
            
            if ($registration->save())
            {
                Yii::log('New registration saved correctly', CLogger::LEVEL_INFO);
            }
            else
            {
                Yii::log('New registration saved errorly', CLogger::LEVEL_INFO);
            }
            
            $this->layout = '//layouts/iframe';
        
            $criteria = Registration::model()->getNotYetSelectedCriteria($this->_patient);

            $dataProvider=new CActiveDataProvider('Mrtscan', array(
                'criteria'=>$criteria,
            ));
            $this->render('mrtscansdetail',array(
                'dataProvider'=>$dataProvider,
                'patientId'=>$this->_patient->id,
            ));

                //Close the dialog, reset the iframe and update the grid
    //            echo CHtml::script("window.$.fn.yiiGridView.update('{$_GET['gridId']}');");
        }        
        Yii::app()->end();
    }
    
    public function actionSave()
    {
        $r = Yii::app()->getRequest();
        
        $attribute = $r->getParam('attribute');
        $value = $r->getParam('value');
        $registrationId  = $r->getParam('id');
       
        $registration = Registration::model()->findByPk($registrationId);
        if(is_null($registration))
            Yii::app()->end();
        
        $old_value = $registration->{$attribute};
        $price_with_discont_old_value = $registration->price_with_discont;
        // we can check whether is comming from a specific grid id too
        // avoided for the sake of the example
        if($r->getParam('editable'))
        {
            $registration->{$attribute} = $value;
            
            if ($attribute === 'discont')
            {
                $registration->price_with_discont = $registration->price-$registration->discont;
                if ($registration->validate(array('discont', 'price_with_discont')) && $registration->saveAttributes(array('discont', 'price_with_discont')))
                {
                    echo $value;
                    echo CHtml::script("window.$.fn.yiiGridView.update('PatientRegistrationGrid');");
                }
                else
                {
                    $error = $registration->getError($attribute);

                    echo $old_value;                
                    echo CHtml::script("alert('{$error}');");
                }
            }
                
        }
        
        Yii::app()->end();
        
    }
}
