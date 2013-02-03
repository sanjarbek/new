<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'DoctorGrid',
	'dataProvider'=>$model->with('hospital')->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40px',
            ),
        ),
		'fullname',
		'phone',
		'type',
        array(
            'type'=>'raw',
            'name'=>'hospital_id',
            'value'=>'CHtml::link(CHtml::encode($data->hospital->name), 
                    array("hospital/view", "id"=>$data->hospital_id))',
            'filter'=>$model->getHospitalsList(),
        ),
		array(
            'name'=>'status',
            'value'=>'$data->getStatusText()',
            'filter'=>$model->getStatusOptions(),
        ),
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
));
?>
