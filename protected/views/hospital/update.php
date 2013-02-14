<?php
$this->breadcrumbs=array(
	'Больницы'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Показать','url'=>array('view','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="well well-large">
    <h4>Редактировать больницу #<?php echo $model->id; ?></h4>

    <?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

</div>