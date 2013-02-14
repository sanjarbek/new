<?php
$this->breadcrumbs=array(
	'Пользователи',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="well">
    <h4>Список пользователей</h4>
</div>
    <?php $this->widget('bootstrap.widgets.TbGridView',array(
        'enableSorting'=>FALSE,
        'dataProvider'=>$dataProvider,
        'type'=>'striped condensed bordered',
        'columns'=>array(
            'id',
            'fullname',
            'email',
            'lastvisit_at',
        )
    )); ?>