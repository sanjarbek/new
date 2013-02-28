<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//$visible=Yii::app()->user->checkAccess("Registrator")? false : true;

$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'RegistratorPatientGrid',
	'dataProvider'=>$model->with('doctor')->search(),
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
            'name'=>'doctor_id',
            'value'=>'$data->doctor->fullname',
            'filter'=>$model->getDoctorsList(),
            'htmlOptions'=>array(
                'width'=>'100px',
            )
        ),
        array(
            'type'=>'raw',
            'name' => 'report',
            'value' => '($data->report==Patient::CONCLUSION_READY) ? 
                "<span class=\"label label-success\">".$data->getConclusionText()."</span>" :
                "<span class=\"label label-warning\">".$data->getConclusionText()."</span>" ',
            'filter'=>$model->getConclusionOptions(),
        ),
        array(
            'type'=>'raw',
            'name' => 'paid',
            'value' => '($data->paid==Patient::PAID_IS_MADE) ? 
                "<span class=\"label label-success\">".$data->getPaidText()."</span>" : (($data->paid==Patient::PAID_IS_DEBT) ?
                "<span class=\"label label-warning\">".$data->getPaidText()."</span>" : 
                "<span class=\"label label-important\">".$data->getPaidText()."</span>")',
            'filter'=>$model->getPaidOptions(),
        ),
        array(
            'type'=>'raw',
            'name'=>'status',
            'value' => '($data->status==Patient::STATUS_FINISHED) ? 
                "<span class=\"label label-success\">".$data->getStatusText()."</span>" : (($data->status==Patient::STATUS_CANCELED) ?
                "<span class=\"label label-warning\">".$data->getStatusText()."</span>" : 
                "<span class=\"label label-important\">".$data->getStatusText()."</span>")',
            'filter'=>$model->getStatusOptions(),
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
//                    'size' => '10',
                ),
            ), 
            true),
        ),
		array(
            'header'=>'<a href="'. Yii::app()->createUrl('patient/create').'" class="icon-plus"></a>',
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{view}{delete}',
            'buttons'=>array(
                'view'=>array(
                    'url'=>'$this->grid->controller->createUrl("/registration/patient", array("pid"=>$data->primaryKey))',
                ),
            ),
		),
	),
));

?>
