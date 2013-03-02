<?php
$this->breadcrumbs=array(
	'Заключения'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
    '',
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить?')),
);
?>

<h4>Показать заключение №<?php echo $model->id; ?></h4>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
//        array(
//            'name'=>'patient_id',
//            'value'=>$model->patient->fullname,
//        ),
//        array(
//            'name'=>'mrtscan_id',
//            'value'=>$model->mrtscan->name,
//        ),
//        array(
//            'name'=>'owner_id',
//            'value'=>$model->owner->fullname,            
//        ),
        array(
            'name'=>'registration_id',
            'value'=>$model->registration->mrtscan->name,
        ),
        array(
            'type'=>'raw',
            'name'=>'file',            
            'value'=>'<a href="'.$model->downloadfilepath.DIRECTORY_SEPARATOR.$model->file.'">Скачать</a>',
        ),
		'description',
		'created_at',
		'updated_at',
		'created_user',
		'updated_user',
	),
)); ?>
