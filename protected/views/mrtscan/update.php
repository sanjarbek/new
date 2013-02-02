<?php
$this->breadcrumbs=array(
	'Mrtscans'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Mrtscan','url'=>array('index')),
	array('label'=>'Create Mrtscan','url'=>array('create')),
	array('label'=>'View Mrtscan','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Mrtscan','url'=>array('admin')),
);
?>

<h1>Update Mrtscan <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>