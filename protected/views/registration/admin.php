<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	'Управлять',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);

?>

<h4>Управление заказами</h4>

<?php $this->renderPartial('_gridview', array(
    'model'=>$model
)); ?>
