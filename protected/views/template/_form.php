<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'template-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5')); ?>

	<?php echo $form->fileFieldRow($model,'template',array(
            'maxFileSize' => 500000,
            'acceptFileTypes' => 'js:/(\.|\/)(docx|xlsx)$/i',
    )); ?>

	<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
