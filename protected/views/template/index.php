<?php
$this->breadcrumbs=array(
	'Шаблоны',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Список шаблонов</h4>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
