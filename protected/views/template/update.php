<?php
$this->breadcrumbs=array(
	'Шаблоны'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Подробнее','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Редактировать <?php echo $model->id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>