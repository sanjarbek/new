<?php
$this->breadcrumbs=array(
	'Пациенты'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="span12">
    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>