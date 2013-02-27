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
            'class'=>'bootstrap.widgets.TbJEditableColumn',
            'saveURL'=>Yii::app()->createUrl('patient/save'),
            'jEditableOptions' => array(
                'tooltip'=>'Click to edit...',
                'type' => 'text',
                // very important to get the attribute to update on the server!
                'submitdata' => array(
                    'attribute'=>'name'
                ),
                'cssclass' => 'form',
                'width' => '150px',
            )
        ),
		'phone',
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
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'patient/report',
            'name' => 'report',
            'checkedButtonLabel'=>'Готово',
            'uncheckedButtonLabel'=>'Пока не готово',
            'filter'=>$model->getReportStatusOptions(),
//            'visible'=>$visible,
        ),
//        array(
//            'name'=>'report',
//            'value'=>'$data->getReportStatusText()',
//            'visible'=>!$visible,
//        ),
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'patient/toggle',
            'name' => 'payment',
            'checkedButtonLabel'=>'Готово',
            'uncheckedButtonLabel'=>'Пока не готово',
            'filter'=>$model->getPaymentOptions(),
        ),
        array(
            'name'=>'status',
            'value'=>'$data->getStatusText()',
            'filter'=>$model->getStatusOptions(),
            'class'=>'bootstrap.widgets.TbJEditableColumn',
            'saveURL'=>Yii::app()->createUrl('patient/save'),
            'jEditableOptions' => array(
                'tooltip'=>'Click to edit...',
                'type' => 'select',
                'data'=>$model->getStatusOptions(),
                // very important to get the attribute to update on the server!
                'submitdata' => array(
                    'attribute'=>'status'
                ),
                'cssclass' => 'form',
//                'width' => '150px',
            )
        ),
		'updated_at',
		/*
		'created_user',
		'updated_user',
		*/
		array(
//            'header'=>
//            $this->widget('bootstrap.widgets.TbButtonGroup', array(
//                'size'=>'mini',
////                'icon'=>'icon-wrench',
//                'buttons'=>array(
//                    array(
//                        'label'=>'Создать',
//                        'icon'=>'icon-plus',
//                        'url'=>array('create'),
//                    )
//                )
//            )),
//            'header'=>'<a href="'. Yii::app()->createUrl('patient/create').'><span class="icon-plus"></span></a>',
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
