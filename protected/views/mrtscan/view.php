<?php
$this->breadcrumbs=array(
	'Mrtscans'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Mrtscan','url'=>array('index')),
	array('label'=>'Create Mrtscan','url'=>array('create')),
	array('label'=>'Update Mrtscan','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Mrtscan','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mrtscan','url'=>array('admin')),
);
?>

<h3>View Mrtscan #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'price',
		array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
		'created_at',
		'updated_at',
		array(
            'name'=>'created_user',
            'value'=>CHtml::encode($model->creator->fullname),
        ),
		array(
            'name'=>'updated_user',
            'value'=>CHtml::encode($model->updater->fullname),
        ),
	),
)); ?>
