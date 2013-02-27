<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'mrtscan-form',
	'enableAjaxValidation'=>false,
    'type'=>'horizontal',
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textAreaRow($model,'description',array('class'=>'span5','rows'=>5, 'maxcolumns'=>30)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span2','maxlength'=>10)); ?>

    <?php echo $form->select2Row($model, 'status', array(
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions(),
    )); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
