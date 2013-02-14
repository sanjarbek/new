<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'UserGrid',
    'type'=>'striped condensed bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'fullname',
		'username',
		'email',
		'lastvisit_at',
		'superuser',
		array(
            'name'=>'status',
            'value'=>'$data->getStatusText()',
            'filter'=>$model->getStatusOptions(),
        ),
        array(
            'name'=>'type',
            'value'=>'$data->getTypeText()',
            'filter'=>$model->getUserTypes(),
        ),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));
?>
