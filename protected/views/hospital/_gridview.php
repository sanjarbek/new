<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'hospitalgrid',
	'dataProvider'=>$model->with('manager')->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40px',
            ),
        ),
		'name',
		'phone',
        array(
            'type'=>'raw',
            'name'=>'manager_id',
            'value'=>'CHtml::link(CHtml::encode($data->manager->name),
                array("user/view", "id"=>$data->manager_id))',
            'filter'=>$model->getManagersList(),
        ),
		array(
            'name'=>'status',
            'value'=>'$data->getStatusText()',
            'filter'=>$model->getStatusOptions(),
        ),
		'created_at',
		/*
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
