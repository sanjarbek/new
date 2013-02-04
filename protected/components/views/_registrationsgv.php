<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->beginWidget('bootstrap.widgets.TbBox', array(
    'title' => 'Mrtscans',
    'headerIcon' => 'icon-th-list',
    // when displaying a table, if we include bootstra-widget-table class
    // the table will be 0-padding to the box
    'htmlOptions' => array('class'=>'bootstrap-widget-table')
));
    $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'RegistrationWidgetGrid',
        'dataProvider'=>$dataProvider,
//        'type'=>'striped bordered condensed',
        'type'=>'bordered condensed',
        'enableSorting' => false,
        'ajaxUrl' => Yii::app()->createUrl('/registration/patientregistrations', array('pid'=>$pid)),
        'template'=>'{items}{pager}{summary}',
        'htmlOptions'=>array(
            'padding'=>'10px',
        ),
        'columns'=>array(
            array(
                'name'=>'id',
                'htmlOptions'=>array(
                    'width'=>'40',
                )
            ),
            array(
                'name'=>'mrtscan_id',
                'value'=>'CHtml::encode($data->mrtscan->name)',
            ),
            'price',
            'discont',
            'price_with_discont',
            /*
            'status',
            'report_status',
            'report_text',
            'created_at',
            'updated_at',
            'created_user',
            'updated_user',
            */
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'header'=>'<i class="icon-wrench"></i>',
            ),
        ),
    ));
$this->endWidget();
?>
