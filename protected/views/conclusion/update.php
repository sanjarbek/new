<?php
$this->breadcrumbs=array(
	'Заключения'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Показать','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управлятьы','url'=>array('admin')),
);
?>

<h4>Редактирование заключения №<?php echo $model->id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>