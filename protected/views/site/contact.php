<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Contact Us';
$this->breadcrumbs=array(
	'Contact',
);
?>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

	<?php echo Yii::app()->user->getFlash('contact'); ?>
<?php else: ?>
<div class="span12">
<p>
If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
</p>    
</div>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php // echo $form->errorSummaryRow($model); ?>

		<?php echo $form->textFieldRow($model,'name'); ?>
		<?php echo $form->textFieldRow($model,'email'); ?>
		<?php echo $form->textFieldRow($model,'subject',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->textAreaRow($model,'body',array('rows'=>6, 'cols'=>50)); ?>
	<?php if(CCaptcha::checkRequirements()): ?>
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	<?php endif; ?>
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Submit',
            'type'=>'primary',
        )); ?>

<?php $this->endWidget(); ?>

<?php endif; ?>