<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'DoctorPatientGrid',
	'dataProvider'=>$model->with('doctor')->paid()->search(),
    'template'=>'{items}{pager}{summary}',
    'type'=>'bordered condensed',
//    'rowCssClassExpression'=>'($data->status==Patient::STATUS_FINISHED)?"success":"warning"',
    'enableSorting'=>false,
    'ajaxUrl'=> $this->createUrl('/patient/index'),
    'ajaxUpdate'=>TRUE,
    'afterAjaxUpdate'=>"js:function(){
        $('#datepicker_for_created_at').bdatepicker({'format':'yyyy-mm-dd', 'weekStart':'1', 'language':'ru', 'autoclose':'true'});
        }",
    'pagerCssClass'=>'pagination pagination-mini pagination-centered',
    'responsiveTable'=>FALSE,
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
        array(
            'name'=>'fullname',
        ),
        array(            
            'name' => 'sex',
            'value'=> '$data->getSexText()',
            'filter'=>$model->getSexOptions(),
        ),
        array(
            'type'=>'raw',
            'name'=>'doctor_id',
            'value'=>  'CHtml::link($data->doctor->fullname, "#myModal", array("onClick"=>"js: $(\"#doctor_details_frame\").attr(\"src\", \"".Yii::app()->createUrl("doctor/getpatientdoctorinfo", array(
                        "did"=>$data->doctor_id,
                        "asDialog"=>1,
                    ))."\")", "data-toggle"=>"modal"))',
            'filter'=>$model->getDoctorsList(),
            'htmlOptions'=>array(
                'width'=>'100px',
            )
        ),
		array(
            'name'=>'created_at',
            'filter' => $this->widget('bootstrap.widgets.TbDatePicker', array(
                'model'=>$model, 
                'attribute'=>'created_at',
                'options'=>array(
                    'language'=>'ru',
                    'format'=>'yyyy-mm-dd',
                    'weekStart'=>1,
                    'autoclose'=>true,
                ),
                'htmlOptions' => array(
                    'id' => 'datepicker_for_created_at',
                    'size' => '10',
                ),
            ), 
            true),
        ),
		'updated_at',
        array(
            'name' => 'report',
            'filter'=>$model->getReportStatusOptions(),
            'value'=>'$data->getReportStatusText()',
            'htmlOptions' => array(
                'width' => '100px',
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}',
//            'buttons'=>array(
//                'view'=>array(
//                    'url'=>'$this->grid->controller->createUrl("/registration/patient", array("pid"=>$data->primaryKey))',
//                ),
//            ),
        ),
	),
));

?>
