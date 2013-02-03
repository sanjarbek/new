<?php
$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Doctor','url'=>array('index')),
	array('label'=>'Manage Doctor','url'=>array('admin')),
);
?>

<div class="well">
    <h3>Create Doctor</h3>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>