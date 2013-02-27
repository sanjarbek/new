<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Подробно','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<!--<h3>Update Registration <?php // echo $model->id; ?></h3>-->

<?php echo $this->renderPartial('_form',array('model'=>$model, 'patient'=>$patient)); ?>