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
            'patientContext + 
                create 
                patient 
                update 
                patientRegistrations 
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
    public function _getGridViewRegistrationGridRegistrator()
    {
        $model=new Registration('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Registration']))
			$model->attributes=$_GET['Registration'];

        $model->patient_id = $this->_patient->id;
        
        $this->renderPartial('_gridview_registrator', array(
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
    
    public function _getGridViewRegistrationGridDoctor()
    {
        $model=new Registration('search');
		$model->unsetAttributes();  // clear any default values
		
        $model->patient_id = $this->_patient->id;
        
        $this->renderPartial('_gridview_doctor', array(
            'model'=>$model,
            'patient'=>  $this->_patient,
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
            $registration->status = Registration::STATUS_NEW;
            
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
        
        $attribute = $r->getParam('name');
        $value = $r->getParam('value');
        $registrationId  = $r->getParam('pk');
       
        $registration = Registration::model()->findByPk($registrationId);
        if(is_null($registration))
            Yii::app()->end();
        
        $old_value = $registration->{$attribute};
        $price_with_discont_old_value = $registration->price_with_discont;
        // we can check whether is comming from a specific grid id too
        // avoided for the sake of the example
//        if($r->getParam('editable'))
//        {
            $registration->{$attribute} = $value;
            
            if ($attribute === 'discont')
            {
                $registration->price_with_discont = $registration->price-$registration->discont;
                if ($registration->validate(array('discont', 'price_with_discont')) && $registration->saveAttributes(array('discont', 'price_with_discont')))
                {
//                    echo $value;
//                    echo CHtml::script("window.$.fn.yiiGridView.update('RegistrationGridRegistrator');");
                }
                else
                {
                    $error = $registration->getError($attribute);

                    echo $old_value;                
                    echo CHtml::script("alert('{$error}');");
                }
            }
                
//        }
        
        Yii::app()->end();
        
    }
    public function actionSaveOld()
    {
        $r = Yii::app()->getRequest();
        
        $attribute = $r->getParam('name');
        $value = $r->getParam('value');
        $registrationId  = $r->getParam('pk');
       
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
                    echo CHtml::script("window.$.fn.yiiGridView.update('RegistrationGridRegistrator');");
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
    
    public function actionGetTemplate($rid)
    {
        $model = $this->loadModel($rid);
        
        // Turn off our amazing library autoload
        spl_autoload_unregister(array('YiiBase','autoload'));

        // get a reference to the path of PHPExcel classes
        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');


        // making use of our reference, include the main class
        // when we do this, phpExcel has its own autoload registration
        // procedure (PHPExcel_Autoloader::Register();)
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

        spl_autoload_register(array('YiiBase', 'autoload'));

        $fileType = 'Excel2007';
        $readFileName = 'conclusion_template.xlsx';
        $writeFileName = $model->patient->fullname . '_' . $model->mrtscan->name . '_('. Date('d.m.Y') .').xlsx';


        // Read the file
        $objReader = PHPExcel_IOFactory::createReader($fileType);
//        $objPHPExcel = $objReader->load(Yii::app()->basePath.'/data/excel_templates/test_xlsx1.xlsx');
//        $objPHPExcel = $objReader->load(Yii::app()->basePath.'/data/excel_templates/conclusion_template.xlsx');
        $objPHPExcel = $objReader->load(Yii::app()->basePath.'/data/templates/'. $readFileName);


        $creator = Yii::app()->user->getState('fullname');
        
        $today = time();
        $patient_birthday = strtotime($model->patient->birthday);
        $seconds_diff = $today - $patient_birthday;
        $age = (int)($seconds_diff/3600/24/360);
        
        $mrtscan_name = strtolower((string)$model->mrtscan->name); 
        
//        $objPHPExcel = new PHPExcel();

        // Set properties
        $objPHPExcel->getProperties()->setCreator($creator)
            ->setLastModifiedBy($creator)
            ->setTitle("Semamed MRT conclusion report")
            ->setSubject("Report")
            ->setDescription("Conclusion file, generated on Semamed Mtd.")
            ->setKeywords("Semamed MRT")
            ->setCategory("Report");
        
        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', 'ПРОТОКОЛ МАГНИТНО-РЕЗОНАНСНОЙ ТОМОГРАФИИ ' . $mrtscan_name)
            ->setCellValue('D5', Date('d.m.Y'))
            ->setCellValue('I5', Date('d.m.Y'))
            ->setCellValue('D6', $model->patient->fullname)
            ->setCellValue('D7', Date('d.m.Y', $patient_birthday))
            ->setCellValue('D9', $creator)
            ->setCellValue('G7', $age . ' лет')
            ->setCellValue('J7', Yii::t('value', $model->patient->getSexText()))
            ->setCellValue('B16', 'Врач ' . $creator)
            ->setCellValue('D8', $model->patient->doctor->fullname);

//         Miscellaneous glyphs, UTF-8
//        $objPHPExcel->setActiveSheetIndex(0)
//            ->setCellValue('A20', 'Miscellaneous glyphs')
//            ->setCellValue('A25', 'Өнүктүрөйлү деп жатабыз @ Hello World');

        // Rename sheet
//        $objPHPExcel->getActiveSheet()->setTitle('Simple');

        // Set active sheet index to the first sheet,
        // so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        ob_end_clean();
        ob_start();

        // Redirect output to a client’s web browser (Excel2007)
        header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//        header("Content-type: application/vnd.ms-excel");
        header('Content-Disposition: attachment;filename="'. $writeFileName .'"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        Yii::app()->end();
    }

}
