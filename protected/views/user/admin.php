<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User','url'=>array('index')),
	array('label'=>'Create User','url'=>array('create')),
);

?>

<div class="well">
<h3>Manage Users</h3>

<?php $this->renderPartial('_gridview', array(
    'model'=>$model,
)) ?>
</div>