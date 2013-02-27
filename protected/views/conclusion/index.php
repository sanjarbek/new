<?php
$this->breadcrumbs=array(
	'Conclusions',
);

$this->menu=array(
	array('label'=>'Create Conclusion','url'=>array('create')),
	array('label'=>'Manage Conclusion','url'=>array('admin')),
);
?>

<h1>Conclusions</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
