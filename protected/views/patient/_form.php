<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'patient-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
//        'class'=>'well',
    )
)); ?>
    
	<!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->
    <p />
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span3','maxlength'=>20)); ?>

	<?php echo $form->datepickerRow($model,'birthday',array(
        'class'=>'span5', 
        'prepend'=>'<i class="icon-calendar"></i>',
        'options'=>array(
            'format'=>'yyyy-mm-dd',
            'calendarWeeks'=>true,
            'startView'=>'decade',
        ),
    )); ?>
    <?php echo $form->select2Row($model, 'sex', array(
        'asDropDownList'=>true,
        'data'=>$model->getSexOptions(),
    )); ?>
    
    <?php echo $form->select2Row($model, 'doctor_id', array(
        'asDropDownList'=>true,
        'data'=>$model->getDoctorsList(),
//        'options'=>array(
//                    'width'=>'200px',
//        )
    )); ?>
    
    <?php echo $form->select2Row($model, 'status', array(
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions(),
//        'options'=>array(
//                    'width'=>'200px',
//        )
    )); ?>
    
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
            'htmlOptions'=>array(
                'class'=>'pull-right',
            )
		)); ?>
	</div>

<?php $this->endWidget(); ?>
