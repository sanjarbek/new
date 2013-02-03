<?php
$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Doctor','url'=>array('index')),
	array('label'=>'Create Doctor','url'=>array('create')),
);

?>

<h3>Manage Doctors</h3>

<?php $this->renderPartial('_gridview', array(
    'model'=>$model,
)) ?>
