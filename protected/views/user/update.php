<?php
$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
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

<div class="well">
    <h4>Редактировать пользователя #<?php echo $model->id; ?></h4>
</div>
<div class="well">
    <?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>