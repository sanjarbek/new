<?php
$this->breadcrumbs=array(
	'Hospitals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Hospital','url'=>array('index')),
	array('label'=>'Create Hospital','url'=>array('create')),
);
?>

<h3>Manage Hospitals</h3>

<?php
$this->renderPartial('_gridview', array(
    'model'=>$model,
));
?>
