<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'hospital-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>
    
    <?php echo $form->select2Row($model, 'parent_id', array(
        'asDropDownList'=>true,
        'data'=>$model->getParentHospitalsList(),
        
    )); ?>

	<?php echo $form->textFieldRow($model,'shortname',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textAreaRow($model,'fullname',array('class'=>'span5','rows'=>5, 'maxlength'=>255)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span3','maxlength'=>20)); ?>

    <?php echo $form->select2Row($model, 'manager_id', array(
        'asDropDownList'=>true,
        'data'=>$model->getManagersList(),
    )); ?>

    <?php echo $form->select2Row($model, 'status', array(
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions(),
    )); ?>
    <?php echo $form->error($model, 'status'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
