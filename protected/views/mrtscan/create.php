<?php
$this->breadcrumbs=array(
	'Услуги'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Создать новую услугу</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>