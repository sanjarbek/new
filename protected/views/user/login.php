<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions'=>array(
        'class'=>'well',
    ),
)); ?>
    <p>Please fill out the following form with your login credentials:</p>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php echo $form->textFieldRow($model,'username', array(
        )); ?>
		<?php echo $form->passwordFieldRow($model,'password', array(
            'hint'=>'Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.',
        )); ?>
		<?php echo $form->checkBoxRow($model,'rememberMe'); ?>
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Login',
        )) ?>
	

<?php $this->endWidget(); ?>

