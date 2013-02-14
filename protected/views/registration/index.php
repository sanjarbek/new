<?php
$this->breadcrumbs=array(
	'Заказы',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Список заказов</h4>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
