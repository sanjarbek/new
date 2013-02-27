<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'ConclusionGrid',
    'type'=>'striped condensed bordered',
	'dataProvider'=>$model->with('patient', 'mrtscan', 'owner')->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
        array(
            'name'=>'patient_id',
            'value'=>'$data->patient->fullname',
        ),
        array(
            'name'=>'mrtscan_id',
            'value'=>'$data->mrtscan->name',
        ),
        array(
            'name'=>'owner_id',
            'value'=>'$data->owner->fullname',
            'filter'=>User::model()->getUsersList('Doctor'),
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