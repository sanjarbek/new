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
//                    'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                    'click'=>"function() {
                        window.$.fn.yiiGridView.update('PatientMrtscanGrid'); 
                        return false;
                    }",
                    'options'=>array(
                        'ajax'=>array(
                            'url'=>"js:
                                $(this).attr('href');
                                ",
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
