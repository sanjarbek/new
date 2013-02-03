<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname', array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>20)); ?>

	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->dropDownListRow($model,'superuser', array(0=>'Super', 1=>'Not super'), array('class'=>'span2')); ?>

	<?php echo $form->dropDownListRow($model,'status', $model->getStatusOptions(), array('class'=>'span3')); ?>

	<?php echo $form->dropDownListRow($model,'type', $model->getUserTYpes(), array('class'=>'span3')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
