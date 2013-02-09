<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'PatientRegistrationGrid',
	'dataProvider'=>$model->with('mrtscan')->search(),
//	'filter'=>$model,
    'enableSorting'=>false,
    'type'=>'bordered condensed',
    'template'=>'{items}{pager}{summary}',
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            ),
        ),
		array(
            'name'=>'mrtscan_id',
            'value'=>'CHtml::encode($data->mrtscan->name)',
            'filter'=>$model->getMrtscansList(),
            'footer'=>'<b><i>'.Yii::t('text','Total').'</i></b>',
        ),
		array(
            'name'=>'price',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
//		array(
//            'name'=>'discont',
//            'class'=>'bootstrap.widgets.TbTotalSumColumn',
//        ),
        array(
            'name'=>'discont',
            'class'=>'bootstrap.widgets.TbJEditableColumn',
            'saveURL'=>Yii::app()->createUrl('registration/save'),
            'jEditableOptions' => array(
                'tooltip'=>'Click to edit...',
                'type' => 'text',
                // very important to get the attribute to update on the server!
                'submitdata' => array(
                    'attribute'=>'discont'
                ),
                'cssclass' => 'form',
                'width' => '150px',
            )
        ),
		array(
            'name'=>'price_with_discont',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
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
            'template'=>'{view}{update}{delete}',
            'buttons'=>array(                
                'update'=>array(
                    'url'=>'$this->grid->controller->createUrl("update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id, "pid"=>$data->patient_id))',
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
