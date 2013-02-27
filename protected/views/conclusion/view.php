<?php
$this->breadcrumbs=array(
	'Conclusions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Conclusion','url'=>array('index')),
	array('label'=>'Create Conclusion','url'=>array('create')),
	array('label'=>'Update Conclusion','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Conclusion','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Conclusion','url'=>array('admin')),
);
?>

<h1>View Conclusion #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'mrtscan_id',
		'owner_id',
		'file',
		'description',
		'created_at',
		'updated_at',
		'created_user',
		'updated_user',
	),
)); ?>
