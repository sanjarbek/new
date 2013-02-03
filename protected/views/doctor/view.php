<?php
$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Doctor','url'=>array('index')),
	array('label'=>'Create Doctor','url'=>array('create')),
	array('label'=>'Update Doctor','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Doctor','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Doctor','url'=>array('admin')),
);
?>

<h3>View Doctor #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'phone',
		'type',
		array(
            'name'=>'hospital_id',
            'value'=>$model->hospital->name,
        ),
		array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
        array(
            'label'=>'Patients count',
            'value'=>count($model->patients),
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
	),
)); ?>
