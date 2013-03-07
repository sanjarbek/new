<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'ManagerForm',
    'action'=>array('report/manager'),
//    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'manager', User::model()->getUsersList('Manager'),
        array(
            'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('hospital/getmanagerhospitalslist'), 
                'update'=>'#'.CHtml::activeId($model,'hospital'), 
                'data'=>array('manager'=>'js:this.value'),
            ),
            'class'=>'span11',
        )  
    ); ?>
	<?php 
    $hospitals = array();
    if (isset($model->manager)) 
        $hospitals = CHtml::listData(Hospital::model()->findAll(
                'manager_id=:managerId', array(':managerId'=>$model->manager)), 'id', 'shortname');
    
    $hospitals = array('0'=>'Все') + $hospitals; 
    
    echo $form->dropDownListRow($model,'hospital', $hospitals,
         array(
            'ajax' => array(
                'type'=>'POST', //request type
                'url'=>CController::createUrl('doctor/gethospitaldoctorslist'), 
                'update'=>'#'.CHtml::activeId($model,'doctor'), 
                'data'=>array('hospital'=>'js:this.value'),
            ),
            'class'=>'span11',
        )     
    ); ?>
	<?php 
    $doctors = array();
    if (isset($model->hospital)) 
        $doctors = CHtml::listData(Doctor::model()->findAll(
                'hospital_id=:hospitalId', array(':hospitalId'=>$model->hospital)), 'id', 'fullname');
    
    $doctors = array('0' => 'Все') + $doctors;
    
    echo $form->dropDownListRow($model,'doctor', $doctors,
        array(
            'class'=>'span11',
        )); ?>
    <hr />
	<?php echo $form->dropDownListRow($model,'year', ManagerForm::getYearsList(),
            array(
                'class'=>'span11',
            )); ?>
	<?php echo $form->dropDownListRow($model,'month', ManagerForm::getMonthsList(),
            array(
                'class'=>'span11',
            )); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
            'size'=>'small',
			'label'=>'Показать',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
