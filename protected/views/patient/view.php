<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Create Patient','url'=>array('create')),
	array('label'=>'Update Patient','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Patient','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Patient','url'=>array('admin')),
);
?>

<h3>View Patient #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'phone',
		'birthday',
		array(
            'name'=>'sex',
            'value'=>$model->getSexText(),
        ),
        array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
        array(
            'name'=>'doctor_id',
            'value'=>CHtml::encode($model->doctor->fullname),
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
