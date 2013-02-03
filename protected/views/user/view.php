<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Update User','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete User','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<div class="well">
<h3>View User #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'username',
		'password',
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
</div>