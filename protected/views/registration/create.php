<?php
$this->breadcrumbs=array(
	'Registrations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Registration','url'=>array('index')),
	array('label'=>'Manage Registration','url'=>array('admin')),
);
?>

<h3>Create Registration</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>