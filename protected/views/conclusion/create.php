<?php
$this->breadcrumbs=array(
	'Заключения'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Новое заключение</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>