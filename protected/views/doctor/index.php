<?php
$this->breadcrumbs=array(
	'Doctors',
);

$this->menu=array(
	array('label'=>'Create Doctor','url'=>array('create')),
	array('label'=>'Manage Doctor','url'=>array('admin')),
);
?>

<h3>Doctors</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
