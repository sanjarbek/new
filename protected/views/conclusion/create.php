<?php
$this->breadcrumbs=array(
	'Conclusions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Conclusion','url'=>array('index')),
	array('label'=>'Manage Conclusion','url'=>array('admin')),
);
?>

<h1>Create Conclusion</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>