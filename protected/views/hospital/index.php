<?php
$this->breadcrumbs=array(
	'Hospitals',
);

$this->menu=array(
	array('label'=>'Create Hospital','url'=>array('create')),
	array('label'=>'Manage Hospital','url'=>array('admin')),
);
?>

<div class="well">
    <h3>Hospitals</h3>
    
    <?php $this->widget('bootstrap.widgets.TbListView',array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',        
    )); ?>
</div>