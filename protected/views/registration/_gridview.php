<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'RegistrationGrid',
    'type'=>'striped condensed bordered',
	'dataProvider'=>$model->with('patient', 'mrtscan')->search(),
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
            'value'=>'CHtml::encode($data->patient->fullname)',
            'filter'=>$model->getPatientsList(),
        ),
		array(
            'name'=>'mrtscan_id',
            'value'=>'CHtml::encode($data->mrtscan->name)',
            'filter'=>$model->getMrtscansList(),
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
		),
	),
));
?>
