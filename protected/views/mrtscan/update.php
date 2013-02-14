<?php
$this->breadcrumbs=array(
	'Услуги'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Подробно','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Редактировать услугу #<?php echo $model->id; ?></h4>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>