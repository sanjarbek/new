<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'template-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'owner_id',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'file',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
