<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'conclusion-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'registration_id', array(
        'class'=>'span5',
        'value'=>$mrtscan_name,
        'readonly'=>true,
    )); ?>

	<?php echo $form->fileFieldRow($model,'conclusion',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
