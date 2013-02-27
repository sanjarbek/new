<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'PatientRegistrationGrid',
	'dataProvider'=>$model,
    'enableSorting'=>false,
    'type'=>'bordered condensed striped',
    'template'=>'{items}',
	'columns'=>array(
		array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
		array(
            'name'=>'mrtscan_id',
            'value'=>'CHtml::encode($data->mrtscan->name)',
        ),
	),
));
?>
