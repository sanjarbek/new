<?php
$this->breadcrumbs=array(
	'Registrations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Registration','url'=>array('index')),
	array('label'=>'Create Registration','url'=>array('create')),
);

?>

<h3>Manage Registrations</h3>

<?php $this->renderPartial('_gridview', array(
    'model'=>$model
)); ?>
