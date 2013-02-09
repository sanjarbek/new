<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Create Patient','url'=>array('create')),
	array('label'=>'Update Patient','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Patient','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Patient','url'=>array('admin')),
    array('label'=>'Add registration', 'url'=>array('registration/create', 'pid'=>$model->id)),
);
?>

<div class="row-fluid">
<!--<h3>View Patient #<?php // echo $model->id; ?></h3>-->

<?php 
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Detail info',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table span5')
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
            'name'=>'report_status', 
            'value'=>$model->getReportStatusText(),
        ),
		'created_at',
		'updated_at',
		array(
            'name'=>'created_user',
            'value'=>CHtml::encode($model->creator->fullname),
        ),
        array(
            'name'=>'updated_user',
            'value'=>CHtml::encode($model->updater->fullname),
        ),
	),
)); 
$this->endWidget();
?>
    <div class="span7">
    <?php
        $this->widget('RegistrationsWidget', array(
            'patient_id'=>$model->id,
        ));
    ?>
    </div>
</div>
