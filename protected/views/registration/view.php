<?php
$this->breadcrumbs=array(
	'Registrations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Registration','url'=>array('index')),
	array('label'=>'Create Registration','url'=>array('create')),
	array('label'=>'Update Registration','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Registration','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Registration','url'=>array('admin')),
);
?>
<div class="row-fluid">
<?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'View Registration #'. $model->id,
        'headerIcon' => 'icon-th-list',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table span5')
    ));

    $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$model,
        'htmlOptions'=>array(
            
        ),
        'attributes'=>array(
            'id',
            array(
                'name'=>'patient_id',
                'value'=>CHtml::encode($model->patient->fullname),
            ),
            array(
                'name'=>'mrtscan_id',
                'value'=>CHtml::encode($model->mrtscan->name),
            ),
            'price',
            'discont',
            'price_with_discont',
            array(
                'name'=>'status',
                'value'=>$model->getStatusText(),
            ),
            'created_at',
            'updated_at',
            array(
                'name'=>'created_user',
                'value'=>CHtml::encode($model->creator->fullname),
            ),
            array(
                'name'=>'updated_user',
                'value'=>  CHtml::encode($model->updater->fullname),
            ),
        ),
    )); 
    $this->endWidget();
?>

</div>
