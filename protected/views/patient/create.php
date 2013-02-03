<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Manage Patient','url'=>array('admin')),
);
?>

<h3>Create Patient</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>