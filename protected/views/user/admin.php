<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Управлять',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

?>

<div class="well">
<h4>Управление пользователями</h4>
</div>
<?php $this->renderPartial('_gridview', array(
    'model'=>$model,
)) ?>
