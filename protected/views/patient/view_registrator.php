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
        'label'=>'Добавить', 
        'url'=>'#myModal', 
        'linkOptions'=>array(
            'onClick'=>'js: $("#doctor_details_frame").attr("src", "' .
                    Yii::app()->createUrl('//registration/getmrtscanslist', array(
                        'pid'=>$model->id,
                        'asDialog'=>1,
                        'gridId'=>'PatientRegistrationGrid',
                    )) . '");',
            'data-toggle'=>'modal',
        ),
        'visible' => ($model->status == Patient::STATUS_NOT_FINISHED) ? true : false,
    ),
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
    $model->scenario = 'registrator-view';
    $this->renderPartial('_editabledetailview_registrator', array(
        'model'=>$model,
    ));
}
else
{
    $this->renderPartial('_detailview_registrator', array(
        'model'=>$model,
    ));
    
}

$this->endWidget();
?>
</div>
<div class="row-fluid">
<?php
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Области исследований',
        'headerIcon' => 'icon-th-list',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table')
    )); 
?>
<?php
    $this->renderPartial('/registration/_gridview_registrator', array(
        'model'=>$registration,
        'show_discont'=>($model->status==Patient::STATUS_NOT_FINISHED) ? true : false,
    ));
?>
<?php
    $this->endWidget();
?>
</div>
<?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',
        'events'=>array(
            'hide'=>'js: function(){$.fn.yiiGridView.update("RegistrationGridRegistrator");}',
        )
    ));
?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h4>Подробнее ...</h4>
    </div>
 
    <div class="modal-body">
        <iframe id="doctor_details_frame" width="100%" height="100%" frameborder="no"></iframe>
    </div>
 
<?php
    $this->endWidget();
?>

