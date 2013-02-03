<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'patient-form',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'well',
    )
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span3','maxlength'=>20)); ?>

	<?php echo $form->datepickerRow($model,'birthday',array(
        'class'=>'span2', 
        'prepend'=>'<i class="icon-calendar"></i>',
        'options'=>array(
            'format'=>'yyyy-mm-dd',
            'calendarWeeks'=>true,
            'startView'=>'decade',
        ),
    )); ?>

	<?php echo $form->dropDownListRow($model,'sex',$model->getSexOptions(), array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'status',$model->getStatusOptions(), array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'doctor_id', $model->getDoctorsList(), array('class'=>'span3')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
