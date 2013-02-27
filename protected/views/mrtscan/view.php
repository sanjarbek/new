<?php
$this->breadcrumbs=array(
	'Услуги'=>array('index'),
	$model->name,
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

<h4>Подробно об услуге #<?php echo $model->id; ?></h4>

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
