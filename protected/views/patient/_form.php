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

    <?php echo $form->labelEx($model, 'sex'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'sex',
        'asDropDownList'=>true,
        'data'=>$model->getSexOptions(),
//        'options'=>array(
//            'width'=>'200px',
//        )
    ));
    ?>
    <?php echo $form->error($model, 'sex'); ?>

    <?php echo $form->labelEx($model, 'doctor_id'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'doctor_id',
        'asDropDownList'=>true,
        'data'=>$model->getDoctorsList(),
        'options'=>array(
            'width'=>'200px',
        )
    ));
    ?>
    <?php echo $form->error($model, 'doctor_id'); ?>
    
    <?php echo $form->labelEx($model, 'status'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'status',
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions(),
        'options'=>array(
            'width'=>'200px',
        )
    ));
    ?>
    <?php echo $form->error($model, 'status'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
