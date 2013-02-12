<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="row-fluid">
    <div class="span6">
    <?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
//        'title'=>'Logo',
//        'headerIcon'=>'icon-th-list',
        'htmlOptions'=>array(
//            'class'=>'span6',
        )
    ));
    ?>
        <img src="images/logo.png" alt="Semamed" width="span6" />
    
    <?php
    $this->endWidget();
    ?>  
    </div>
        
    <div class="span6">
    <?php 
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title'=>'Login',
        'headerIcon'=>'icon-user',
        'htmlOptions'=>array(
//            'class'=>'span6'
        )
    ));
    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
        'htmlOptions'=>array(
//            'class'=>'span6',
        ),
    )); ?>

            <?php echo $form->textFieldRow($model,'username', array(
            )); ?>
            <?php echo $form->passwordFieldRow($model,'password'); ?>
            <?php echo $form->checkBoxRow($model,'rememberMe'); ?>

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType'=>'submit',
                'label'=>'Login',
            )) ?>


    <?php $this->endWidget(); 
    $this->endWidget();?>
    </div>
</div>

