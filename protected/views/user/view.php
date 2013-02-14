<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить?')),
);
?>

<div class="well">
<h4>Подробно о пользователе #<?php echo $model->id; ?></h4>
</div>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'username',
		'email',
		'created_at',
		'lastvisit_at',
		'superuser',
        array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
        array(
            'name'=>'type',
            'value'=>$model->getTypeText(),
        ),
	),
)); ?>