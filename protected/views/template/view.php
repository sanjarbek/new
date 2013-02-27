<?php
$this->breadcrumbs=array(
	'Шаблоны'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
    '',
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить файл шаблон?')),
);
?>

<h4>Подробнее о шаблоне №<?php echo $model->id; ?></h4>

<?php 
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
        array(
            'name'=>'owner_id',
            'value'=>  CHtml::encode($model->owner->fullname),
        ),
        array(
            'type'=>'raw',
            'name'=>'file',            
            'value'=>'<a href="'.$model->downloadfilepath.DIRECTORY_SEPARATOR.$model->file.'">'.$model->name.'</a>',
        ),
		'description',
	),
)); 

?>
