<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname', array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>20)); ?>


	<?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->labelEx($model, 'superuser'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'superuser',
        'data'=>array(0=>'Super', 1=>'Not super'),
        'options'=>array(
            'width'=>'100px',
        )
    )); ?>
    <?php echo $form->error($model, 'superuser'); ?>

	<?php echo $form->labelEx($model, 'type'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'type',
        'data'=>$model->getUserTypes(),
        'options'=>array(
            'width'=>'150px',
        )
    )); ?>
    <?php echo $form->error($model, 'type'); ?>
    
    <?php echo $form->labelEx($model, 'status'); ?>
    <?php $this->widget('bootstrap.widgets.TbSelect2', array(
        'model'=>$model,
        'attribute'=>'status',
        'data'=>$model->getStatusOptions(),
        'options'=>array(
            'width'=>'100px',
        )
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
