<?php
$this->breadcrumbs=array(
	'Пациенты'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('index')),
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

if ($model->status == Patient::STATUS_NOT_FINISHED)
{
    $model->scenario = 'doctor-view';
    $this->renderPartial('_editabledetailview_doctor', array(
    'model'=>$model,
));
}
else
{
    $this->renderPartial('_detailview_doctor', array(
        'model'=>$model,
    ));
    
}


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
        'show_discont'=>($model->status==Patient::STATUS_NOT_FINISHED) ? true : false,
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
