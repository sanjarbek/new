<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'ConclusionGrid',
    'type'=>'striped condensed bordered',
	'dataProvider'=>$model->with('registration.mrtscan', 'registration.patient')->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
        'registration_id',
        array(
            'name'=>'patient',
//            'header'=>'Пациент',
            'value'=>'$data->registration->patient->fullname',
        ),
        array(
            'name'=>'mrtscan',
            'value'=>'$data->registration->mrtscan->name',
        ),
		'description',
		/*
		'created_at',
		'updated_at',
		'created_user',
		'updated_user',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>