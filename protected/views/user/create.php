<?php
$this->breadcrumbs=array(
	'Пользователя'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="well">
    <h4>Создать нового пользователя</h4>

    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>