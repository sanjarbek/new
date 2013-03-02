<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'RegistrationGridRegistrator',
	'dataProvider'=>$model->with('mrtscan', 'conclus')->search(),
//	'filter'=>$model,
    'enableSorting'=>false,
    'ajaxUrl'=> Yii::app()->createUrl('registration/patientRegistrations', array('pid'=>$model->patient_id)),
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
        array(
            'name'=>'discont',
            'class'=>'bootstrap.widgets.TbJEditableColumn',
            'saveURL'=>Yii::app()->createUrl('//registration/save'),
            'jEditableOptions' => array(
                'tooltip'=>'',
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
        array(
            'type'=>'raw',
            'header'=>'Файл заключения',
            'value'=>'($data->conclus != NULL) ?
                "<a href=\"".$data->conclus->downloadfilepath.DIRECTORY_SEPARATOR.$data->conclus->file."\">Скачать</a>" :
                "Еще не загружен"',
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(    
                'delete'=>array(
                    'url'=>'$this->grid->controller->createUrl("/registration/delete", array("id"=>$data->primaryKey))',
                ),                    
            ),
		),
	),
));
?>
