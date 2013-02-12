<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'RegistratorPatientGrid',
	'dataProvider'=>$model->with('doctor')->search(),
    'template'=>'{items}{pager}{summary}',
    'type'=>'bordered condensed striped',
//    'rowCssClassExpression'=>'($data->status==Patient::STATUS_FINISHED)?"success":"warning"',
    'enableSorting'=>false,
    'ajaxUrl'=> $this->createUrl('/patient/index'),
    'ajaxUpdate'=>false,
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
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'patient/toggle',
            'name' => 'sex',
            'checkedIcon'=>'icon-thumbs-up',
            'uncheckedIcon'=>'icon-thumbs-down',
            'uncheckedButtonLabel'=>'Мужчина',
            'checkedButtonLabel'=>'Женщина',
            'filter'=>$model->getSexOptions(),
        ),
        array(
            'name'=>'doctor_id',
            'value'=>'$data->doctor->fullname',
            'filter'=>$model->getDoctorsList(),
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
        array(
            'class'=>'bootstrap.widgets.TbToggleColumn',
            'toggleAction'=>'patient/toggle',
            'name' => 'report_status',
            'checkedButtonLabel'=>'Готово',
            'uncheckedButtonLabel'=>'Пока не готово',
            'filter'=>$model->getReportStatusOptions(),
        ),
		array(
            'name'=>'created_at',
            'filter' => $this->widget('bootstrap.widgets.TbDatePicker', array(
                'model'=>$model, 
                'attribute'=>'created_at',
                'options'=>array(
                    'format'=>'yyyy-mm-dd',
                ),
                'htmlOptions' => array(
                    'id' => 'datepicker_for_created_at',
                    'size' => '10',
                ),
            ), 
            true),
        ),
		/*
		'updated_at',
		'created_user',
		'updated_user',
		*/
		array(
            'header'=>'Actions',
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
