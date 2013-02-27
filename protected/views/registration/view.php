<?php
$this->breadcrumbs=array(
	'Заказы'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
	array('label'=>'Управлять','url'=>array('admin')),
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?>
<div class="row-fluid">
<?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Подробно о заказе #'. $model->id,
        'headerIcon' => 'icon-th-list',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table span9')
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
