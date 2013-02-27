<?php
$this->breadcrumbs=array(
	'Conclusions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Conclusion','url'=>array('index')),
	array('label'=>'Create Conclusion','url'=>array('create')),
	array('label'=>'View Conclusion','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Conclusion','url'=>array('admin')),
);
?>

<h1>Update Conclusion <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>