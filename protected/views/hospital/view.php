<?php
$this->breadcrumbs=array(
	'Hospitals'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Hospital','url'=>array('index')),
	array('label'=>'Create Hospital','url'=>array('create')),
	array('label'=>'Update Hospital','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Hospital','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Hospital','url'=>array('admin')),
);
?>

<h1>View Hospital #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
		'manager_id',
		'status',
		'created_at',
		'updated_at',
		'created_user',
		'updated_user',
	),
)); ?>
