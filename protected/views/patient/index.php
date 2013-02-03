<?php
$this->breadcrumbs=array(
	'Patients',
);

$this->menu=array(
	array('label'=>'Create Patient','url'=>array('create')),
	array('label'=>'Manage Patient','url'=>array('admin')),
);
?>

<h3>Patients</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
