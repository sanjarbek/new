<?php
$this->breadcrumbs=array(
	'Registrations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Registration','url'=>array('index')),
	array('label'=>'Create Registration','url'=>array('create')),
	array('label'=>'Update Registration','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Registration','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Registration','url'=>array('admin')),
);
?>

<h1>View Registration #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'patient_id',
		'mrtscan_id',
		'price',
		'discont',
		'price_with_discont',
		'status',
		'report_status',
		'report_text',
		'created_at',
		'updated_at',
		'created_user',
		'updated_user',
	),
)); ?>
