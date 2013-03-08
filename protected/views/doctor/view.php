<?php
$this->breadcrumbs=array(
	'Доктора'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
    '',
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h4>Доктор #<?php echo $model->id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'phone',
		'type',
		array(
            'name'=>'hospital_id',
            'value'=>$model->hospital->shortname,
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
	),
)); ?>
