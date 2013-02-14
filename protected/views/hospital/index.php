<?php
$this->breadcrumbs=array(
	'Больницы',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="well">
    <h4>Больницы</h4>
    
    <?php $this->widget('bootstrap.widgets.TbListView',array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',        
    )); ?>
</div>