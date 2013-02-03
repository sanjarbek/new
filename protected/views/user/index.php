<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'Create User','url'=>array('create')),
	array('label'=>'Manage User','url'=>array('admin')),
);
?>

<div class="well">
    <h3>Users</h3>

    <?php $this->widget('bootstrap.widgets.TbListView',array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    )); ?>
</div>