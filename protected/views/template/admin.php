<?php
$this->breadcrumbs=array(
	'Шаблоны'=>array('index'),
	'Управлять',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

?>

<h4>Управление шаблонами</h4>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'template-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'owner_id',
		'file',
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
