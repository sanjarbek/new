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
	'',
	array('label'=>'Удалить','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены что хотите удалить?')),
    '',
    array(
        'label'=>'Загрузить заключение',
        'url'=>'#myModal',
        'linkOptions'=>array(
            'onClick'=>'js: $("#upload_conclusion").attr("src", "' .
                    Yii::app()->createUrl('conclusion/create', array(
                        'pid'=>$model->id,
                        'asDialog'=>1,
                    )) . '");',
            'data-toggle'=>'modal',
            
        ),
    ),
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
$this->widget('bootstrap.widgets.TbEditableDetailView',array(
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
            'name'=>'payment',
            'value'=>$model->getPaymentText(),
        ),
        array(
            'name'=>'report', 
//            'value'=>$model->getReportStatusText(),
            'editable' => array(
                'type' => 'select',
                'source' => $model->getReportStatusOptions(),
            )
        ),
		'created_at',
		array(
            'name'=>'created_user',
            'value'=>CHtml::encode($model->creator->fullname),
        ),
	),
)); 
$this->endWidget();
?>
    <div class="span6">
<?php    
    $this->beginWidget('bootstrap.widgets.TbBox', array(
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

<?php
$this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',
    ));
?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
    <h4>Подробнее ...</h4>
    </div>
 
    <div class="modal-body">
    <iframe id="upload_conclusion" width="100%" height="100%" frameborder="no"></iframe>
    </div>
 

    <div class="modal-footer">
    <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Закрыть',
            'type'=>'primary',
            'url'=>'#',
            'htmlOptions'=>array(
                'data-dismiss'=>'modal'
            ),
        ));
    ?>
    </div>
<?php
    $this->endWidget();
?>

