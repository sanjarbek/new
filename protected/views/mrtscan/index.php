<?php
$this->breadcrumbs=array(
	'Mrtscans',
);

$this->menu=array(
	array('label'=>'Create Mrtscan','url'=>array('create')),
	array('label'=>'Manage Mrtscan','url'=>array('admin')),
);
?>

<h3>Mrtscans</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
