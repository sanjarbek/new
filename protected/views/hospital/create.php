<?php
$this->breadcrumbs=array(
	'Hospitals'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Hospital','url'=>array('index')),
	array('label'=>'Manage Hospital','url'=>array('admin')),
);
?>

<div class="well">
    <h3>Create Hospital</h3>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>