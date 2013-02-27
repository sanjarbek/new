<?php
$this->breadcrumbs=array(
	'Услуги',
);


$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);

?>

<h4>Список услуг</h4>

<?php 
$this->renderPartial('_listview', array(
    'dataProvider'=>$dataProvider,
));
?>
