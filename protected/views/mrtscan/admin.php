<?php
$this->breadcrumbs=array(
	'Mrtscans'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Mrtscan','url'=>array('index')),
	array('label'=>'Create Mrtscan','url'=>array('create')),
);
?>

<h3>Manage Mrtscans</h3>

<?php $this->renderPartial('_gridview', array(
    'model'=>$model
)); ?>
