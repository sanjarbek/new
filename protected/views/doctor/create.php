<?php
$this->breadcrumbs=array(
	'Докторы'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="well">
    <h4>Создать доктора</h4>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>