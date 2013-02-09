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
    array('label'=>'Add registration', 'url'=>'#', 'linkOptions'=>array(
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
    <!--<h3>View Patient #<?php // echo $model->id; ?></h3>-->

    <?php 
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Detail info',
        'headerIcon' => 'icon-th-list',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table span4')
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
                'name'=>'doctor_id',
                'value'=>CHtml::encode($patient->doctor->fullname),
            ),
            'created_at',
            'updated_at',
            array(
                'name'=>'created_user',
                'value'=>CHtml::encode($patient->creator->fullname),
            ),
            array(
                'name'=>'updated_user',
                'value'=>CHtml::encode($patient->updater->fullname),
            ),
        ),
    )); 
    $this->endWidget();
    ?>
    <div class="span8">
        <?php
        $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Detail info',
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
        'title'=>'Detail view',
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