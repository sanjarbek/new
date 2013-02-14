<?php
$this->breadcrumbs=array(
	'Услуги',
);


$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);

?>

<h4>Список услуг</h4>

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
