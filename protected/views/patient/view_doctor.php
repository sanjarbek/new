<?php
$this->breadcrumbs=array(
	'Пациенты'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
	array('label'=>'Редактировать','url'=>array('update','id'=>$model->id)),
);
?>

<div class="row-fluid">
<?php 
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Подробно о пациенте №'.$model->id,
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
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
            'value'=>$model->getConclusionText(),
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
</div>
<div class="row-fluid">
<?php
    Yii::import('application.controllers.RegistrationController');
    $regController = new RegistrationController(399);
    
    $this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Заключения',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
)); 
?>
<?php
    $regController->renderPartial('//registration/_gridview_doctor', array(
        'model'=>$registration,
    ));
?>
<?php
    $this->endWidget();
?>
<?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',
        'events'=>array(
            'hide'=>'js: function(){$.fn.yiiGridView.update("RegistrationGridDoctor");}',
        )
    ));
?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h4>Подробнее ...</h4>
    </div>
 
    <div class="modal-body">
        <iframe id="conclusion_upload_frame" width="100%" height="100%" frameborder="no"></iframe>
    </div>
 
<?php
    $this->endWidget();
?>
</div>
