<?php
$this->breadcrumbs=array(
	'Больницы'=>array('index'),
	'Управлять',
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
);
?>

<h4>Управлять</h4>

<?php
$this->renderPartial('_gridview', array(
    'model'=>$model,
));
?>
