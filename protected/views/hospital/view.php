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

<h3>View Hospital #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'phone',
        array(
            'name'=>'manager_id',
            'value'=>$model->manager->fullname,
        ),
        array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
		'created_at',
		'updated_at',
		array(
            'name'=>'created_user',
            'value'=>$model->creator->fullname,
        ),
		array(
            'name'=>'updated_user',
            'value'=>$model->updater->fullname,
        ),
        array(
            'label'=>'Doctors count',
            'value'=>count($model->doctors),
        ),
	),
)); ?>
