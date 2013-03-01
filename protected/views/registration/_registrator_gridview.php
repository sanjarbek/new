<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$temp = new Registration;
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'PatientRegistrationGrid',
	'dataProvider'=>$model->search(),
    'filter'=>$model,
    'enableSorting'=>TRUE,
    'type'=>'bordered condensed striped hover',
//    'ajaxUrl'=>  Yii::app()->createUrl('//registration/_patient_gridview'),
    'ajaxUrl'=> Yii::app()->createUrl('registration/create', array('pid'=>$model->patient_id)),
    'template'=>'{items}',
	'columns'=>array(
//		array(
//            'name'=>'№',
//            'type'=>'raw',
//            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
//        ),
		array(
            'name'=>'mrtscan_id',
            'value'=>'CHtml::encode($data->mrtscan->name)',
        ),
	),
));
?>
