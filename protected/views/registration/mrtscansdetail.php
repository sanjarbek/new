<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'PatientMrtscanGrid',
    'type'=>'bordered condensed',
    'template'=>'{items}',
	'dataProvider'=>$dataProvider,
    'ajaxUpdate'=>array('PatientMrtscanGrid'),
//    'patientId'=>$patientId,
    'enableSorting'=>false,
	'columns'=>array(
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{add}',
            'buttons'=>array(
                'add'=>array(
                    'icon'=>'icon-plus',
                    'label'=>'Add',
                    'url'=>'$this->grid->controller->createUrl("addService", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id, "pid"=>'.$patientId.'))',
                    'options'=>array(
                        'ajax' => array(
                            'type' => 'get', 
                            'url'=>'js:$(this).attr("href")', 
                            'success' => 'js:function(data) { 
                                $.fn.yiiGridView.update("PatientMrtscanGrid")}',
                        ),
                    ),
                ),
            )
		),
        'id',
        'name',
		'price',
	),
)); 
?>
