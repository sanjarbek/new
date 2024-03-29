<?php
$this->breadcrumbs=array(
	'Пациенты'=>array('/patient/index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список','url'=>array('/patient/index')),
	array('label'=>'Создать','url'=>array('/patient/create')),
	'',
    array('label'=>'Добавить новый заказ', 'url'=>'#', 'linkOptions'=>array(
        'onClick'=>'js: $("#cru-frame").attr("src", "' .
                    Yii::app()->createUrl('registration/getmrtscanslist', array(
                        'pid'=>$patient->id,
                        'asDialog'=>1,
                        'gridId'=>'PatientRegistrationGrid',
                    )) . '");' . 
            '$("#cru-dialog").dialog("open");  
            return false;'),
    ),
);
?>

<div class="row-fluid">

    <?php 
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Подробно о пациенте',
        'headerIcon' => 'icon-th-list',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));
    $this->widget('bootstrap.widgets.TbDetailView',array(
        'data'=>$patient,
        'htmlOptions'=>array(
            
        ),
        'attributes'=>array(
            'id',
            'fullname',
            'phone',
            'birthday',
            array(
                'name'=>'sex',
                'value'=>$patient->getSexText(),
            ),
            array(
                'name'=>'status',
                'value'=>$patient->getStatusText(),
            ),
            array(
                'type'=>'raw',
                'name'=>'doctor_id',
                'value'=> CHtml::link(CHtml::encode($patient->doctor->fullname), '#', array(
                    'onClick'=>'js: $("#doctor-frame").attr("src", "' .
                    Yii::app()->createUrl('doctor/getpatientdoctorinfo', array(
                        'did'=>$patient->doctor_id,
                        'asDialog'=>1,
                    )) . '");' . 
            '$("#doctor-dialog").dialog("open");  
            return false;',
                )),
            ),
            'created_at',
            array(
                'name'=>'created_user',
                'value'=>CHtml::encode($patient->creator->fullname),
            ),
            'updated_at',
            array(
                'name'=>'updated_user',
                'value'=>CHtml::encode($patient->updater->fullname),
            ),
        ),
    )); 
    $this->endWidget();
    ?>
<div class="row-fluid">
        <?php
        $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Области исследований',
            'headerIcon' => 'icon-th-list',
            // when displaying a table, if we include bootstra-widget-table class
            // the table will be 0-padding to the box
            'htmlOptions' => array('class'=>'bootstrap-widget-table')
        ));
            $this->renderPartial('_gridviewpatientsregistrations', array(
                'model'=>$model,
            ));
        $this->endWidget();
        ?>
    </div>

</div>

<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cru-dialog',
    'options'=>array(
        'title'=>'Услуги',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>500,
        'height'=>310,
        'class'=>'mydialogbox',
        'close'=>"js: function(event, ui) { 
            window.parent.$('#cru-frame').attr('src','');
            window.parent.$.fn.yiiGridView.update('PatientRegistrationGrid')}",  
        'closeOnEscape'=>true,
    ),
    ));
    
    
?>
<iframe id="cru-frame" width="100%" height="100%" frameborder="no"></iframe>
<?php $this->endWidget(); ?>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'doctor-dialog',
    'options'=>array(
        'title'=>'Doctor details',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>500,
        'height'=>310,
        'class'=>'mydialogbox',
        'close'=>"js: function(event, ui) { 
            window.parent.$('#doctor-frame').attr('src','');
            }",  
        'closeOnEscape'=>true,
    ),
    ));
?>
<iframe id="doctor-frame" width="100%" height="100%" frameborder="no"></iframe>
<?php $this->endWidget(); ?>