<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>


<?php echo $this->renderPartial('_form', array('model'=>$model, 'patient'=>$patient)); ?>