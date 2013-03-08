<?php
$this->widget('bootstrap.widgets.TbEditableDetailView',array(
    'id'=>'patient-details',
	'data'=>$model,
    'url' => $this->createUrl('patient/editable'),
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
            'name'=>'doctor_id',
            'value'=>CHtml::encode($model->doctor->fullname),
        ),
        array(
            'name'=>'report', 
            'editable'=>array(
                'title'=>'Выберите статус пациента',
                'type'=>'select',
                'source'=>$model->getConclusionOptions(),
            ),
        ),
        array(
            'name'=>'desc_doctor_id', 
            'value'=>($model->desc_doctor_id != 0) ? $model->conclusion_by->fullname : 'Пока не сделан',
        ),
        'reported_at',
        array(
            'name'=>'paid',
            'value'=>$model->getPaidText(),
        ),
        array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
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
?>
