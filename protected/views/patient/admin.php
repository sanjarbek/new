<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Create Patient','url'=>array('create')),
);

?>

<h3>Manage Patients</h3>

<?php $this->renderPartial('_gridview', array(
    'model'=>$model
)); ?>
