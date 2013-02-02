<?php
$this->breadcrumbs=array(
	'Registrations',
);

$this->menu=array(
	array('label'=>'Create Registration','url'=>array('create')),
	array('label'=>'Manage Registration','url'=>array('admin')),
);
?>

<h1>Registrations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
