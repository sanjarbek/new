<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'MrtscanGrid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
		'name',
		'description',
		'price',
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
