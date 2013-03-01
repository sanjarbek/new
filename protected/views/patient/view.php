<?php
$this->breadcrumbs=array(
	'Пациенты'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить?')),
);
?>

<div class="row-fluid">
<!--<h3>View Patient #<?php // echo $model->id; ?></h3>-->

<?php 
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Подробно',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table span6')
));
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
    'htmlOptions'=>array(
//        'class'=>'span4',
    ),
	'attributes'=>array(
		'id',
		'fullname',
		'phone',
		'birthday',
		array(
            'name'=>'sex',
            'value'=>$model->getSexText(),
        ),
        array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
        array(
            'name'=>'doctor_id',
            'value'=>CHtml::encode($model->doctor->fullname),
        ),
        array(
            'name'=>'report', 
            'value'=>$model->getReportStatusText(),
        ),
		'created_at',
		array(
            'name'=>'created_user',
            'value'=>CHtml::encode($model->creator->fullname),
        ),
		'updated_at',
        array(
            'name'=>'updated_user',
            'value'=>CHtml::encode($model->updater->fullname),
        ),
	),
)); 
$this->endWidget();
?>
    <div class="span6">
<?php $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Услуги',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
));
$this->renderPartial('/registration/_patient_gridview_doctor', array(
    'model'=>$registrationDataProvider,
)); 
$this->endWidget();
?>
    </div>
</div>
