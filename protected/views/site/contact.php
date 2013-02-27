<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Связаться с нами',
);
?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

	<?php echo Yii::app()->user->getFlash('contact'); ?>
<?php else: ?>
<div class="span12 well">
<p>
Если у вас имеются вопросы, пожалуйста, заполните форму чтобы связаться с нами. Спасибо вам.
</p>  

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php  echo $form->errorSummary($model); ?>

		<?php echo $form->textFieldRow($model,'name', array('class'=>'span3', 'maxLength'=>20)); ?>
		<?php echo $form->textFieldRow($model,'email'); ?>
		<?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50)); ?>
	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	<?php endif; ?>
        <hr />
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Отправить',
            'type'=>'primary',
        )); ?>

<?php $this->endWidget(); ?>
  
</div>
<?php endif; ?>