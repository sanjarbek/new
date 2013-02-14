<?php

class PatientController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/patient';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return CMap::mergeArray(parent::filters(), array(
			//'accessControl', // perform access control for CRUD operations
            array( // handle gridview ajax update
                'application.filters.GridViewHandler', //path to GridViewHandler.php class
            ),
		));
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'save', 'toggle',),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('sanzhar'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
    
    public function actions()
    {
        return array(
            'toggle' => array(
                'class'=>'bootstrap.actions.TbToggleAction',
                'modelName' => 'Patient',
            )
        );
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
		$model=new Patient;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Patient']))
		{
			$model->attributes=$_POST['Patient'];
			if($model->save())
				$this->redirect(array('/registration/patient','pid'=>$model->id));
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

		if(isset($_POST['Patient']))
		{
			$model->attributes=$_POST['Patient'];
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
		$model=new Patient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patient']))
			$model->attributes=$_GET['Patient'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Patient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patient']))
			$model->attributes=$_GET['Patient'];

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
		$model=Patient::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='patient-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    /**
	 * Manages all models via Ajax.
	 */
	public function _getGridViewPatientGrid()
	{
		$model=new Patient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patient']))
			$model->attributes=$_GET['Patient'];

		$this->renderPartial('_gridview',array(
			'model'=>$model,
		));
	}
    
    /**
	 * Manages all models via Ajax.
	 */
	public function _getGridViewRegistratorPatientGrid()
	{
		$model=new Patient('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patient']))
			$model->attributes=$_GET['Patient'];
        
        Yii::log('WWW Ушундай эле кылыш керек болчу: '. $model->created_at, CLogger::LEVEL_INFO);

		$this->renderPartial('_registrator_gridview',array(
			'model'=>$model,
            'created_at'=>$model->created_at,
		));
	}
    
    public function actionSave()
    {
        $r = Yii::app()->getRequest();
        
        $attribute = $r->getParam('attribute');
        $value = $r->getParam('value');
        $patientId  = $r->getParam('id');
       
        $patient = Patient::model()->findByPk($patientId);
        if(is_null($patient))
            Yii::app()->end();
        
        $old_value = $patient->{$attribute};
        // we can check whether is comming from a specific grid id too
        // avoided for the sake of the example
        if($r->getParam('editable'))
        {
            $patient->{$attribute} = $value;
            if ($patient->saveAttributes(array($attribute)))
            {
                if ($attribute === 'status')
                    echo $patient->getStatusText();
                else
                    echo $value;
            }
            else
            {
                $error = $patient->getError($attribute);

                echo $old_value;                
                echo CHtml::script("alert('{$error}');");
            }
                
            Yii::app()->end();
        }
    }
    
    public function actionGetDoctorsListJson()
    {
        $listData = Patient::model()->getDoctorsList();
        
        $content = '';
        foreach($listData as $optgroup=>$options)
        {
            $content = $content . '<optgroup label="'.$optgroup.'">';
            foreach ($options as $key => $value)
                $content = $content . CHtml::tag('option',
                       array('value'=>$key),CHtml::encode($value),true);
            $content = $content . '</optgroup>';
        }
        
        echo CJSON::encode(array(
                        'status'=>'success',
                        'content'=>$content,
        ));

        Yii::app()->end();
    }
}
