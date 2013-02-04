<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'doctor-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>45)); ?>

    <?php echo $form->labelEx($model, 'type'); ?>
    <?php
        $this->widget('bootstrap.widgets.TbTypeahead', array(
            'model'=>$model,
            'attribute'=>'type',
            'htmlOptions'=>array(
                'autocomplete' => 'off',
            ),
            'options'=>array(
                'source'=> $model->getTypeOptions(),
                'items'=>4,
                'matcher'=>"js:function(item) {
            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
            }",
        )));
    ?>
    <?php echo $form->error($model, 'type'); ?>
	
    <?php // echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>45)); ?>

    <?php echo $form->labelEx($model, 'hospital_id'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'hospital_id',
        'data'=>$model->getHospitalsList(),
    )); ?>
    <?php echo $form->error($model, 'hospital_id'); ?>

    <?php echo $form->labelEx($model, 'status'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'status',
        'data'=>$model->getStatusOptions(),
    )); ?>
    <?php echo $form->error($model, 'status'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
