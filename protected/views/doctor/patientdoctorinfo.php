<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fullname',
		'phone',
		'type',
		array(
            'name'=>'hospital_id',
            'value'=>$model->hospital->name,
        ),
		array(
            'name'=>'status',
            'value'=>$model->getStatusText(),
        ),
	),
)); ?>
