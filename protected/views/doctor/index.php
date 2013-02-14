<?php
$this->breadcrumbs=array(
	'Докторы',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<h4>Список докторов</h4>

<?php
$this->renderPartial('_listview', array(
    'dataProvider'=>$dataProvider,
));
?>
