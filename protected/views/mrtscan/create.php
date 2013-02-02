<?php
$this->breadcrumbs=array(
	'Mrtscans'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Mrtscan','url'=>array('index')),
	array('label'=>'Manage Mrtscan','url'=>array('admin')),
);
?>

<h1>Create Mrtscan</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>