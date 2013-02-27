<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'PatientGrid',
	'dataProvider'=>$model->with('doctor')->search(),
    'template'=>'{items}{pager}{summary}',
    'type'=>'bordered condensed',
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
		'fullname',
		'phone',
		array(
            'name'=>'birthday',   
        ),
		array(
            'name'=>'sex',
            'value'=>'$data->getSexText()',
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
        ),
		'created_at',
		'updated_at',
//		'created_user',
//		'updated_user',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'buttons'=>array(
                'update'=>array(
                    'url'=>'$this->grid->controller->createUrl("update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                    'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                    'label'=>'',
                ),
                'view'=>array(
                    'label'=>'',
                ),
                'delete'=>array(
                    'label'=>'',
                )
            ),
                
		),
	),
));

?>
