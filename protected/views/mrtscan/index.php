<?php
$this->breadcrumbs=array(
	'Mrtscans',
);


$this->menu=array(
	array('label'=>'Create Mrtscan','url'=>array('create')),
	array('label'=>'Manage Mrtscan','url'=>array('admin')),
);

?>


<!--<h3>Mrtscans</h3>-->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'dataProvider'=>$dataProvider,
    'type'=>'bordered condensed striped',
    'template'=>'{summary}{items}{pager}',
    'enableSorting'=>false,
    'columns'=>array(
        'name',
        'description',
        'price',
    )
//	'itemView'=>'_view',
)); ?>
