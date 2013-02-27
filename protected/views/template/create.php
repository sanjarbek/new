<?php
$this->breadcrumbs=array(
	'Шаблоны'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Загрузить шаблон</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>