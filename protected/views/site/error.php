<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<div class="well">
    
    <div class="error">
    <?php echo CHtml::encode($message); ?>
    </div>

</div>

<?php
//$this->widget('bootstrap.widgets.TbAlert', array(
//    'block'=>true, // display a larger alert block?
//    'fade'=>true, // use transitions?
//    'closeText'=>'false', // close link text - if set to false, no close link is displayed
//    'content'=>CHtml::encode($message),
//    'alerts'=>array( // configurations per alert type
//        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'×'), // success, info, warning, error or danger
//    ),
//));
?>