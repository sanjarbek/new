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

<h1>Create Doctor</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>