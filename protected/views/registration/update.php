<?php
$this->breadcrumbs=array(
	'Registrations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Registration','url'=>array('index')),
	array('label'=>'Create Registration','url'=>array('create')),
	array('label'=>'View Registration','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Registration','url'=>array('admin')),
);
?>

<h3>Update Registration <?php echo $model->id; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>