<?php
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'DoctorsList',
	'dataProvider'=>$dataProvider,
    'type'=>'striped bordered condensed',
	'enableSorting'=>false,
//    'mergeColumns'=>array('hospital_id', 'type'),
	'columns'=>array(
        array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
        array(
            'type'=>'raw',
            'name'=>'hospital_id',
            'value'=>'CHtml::link(CHtml::encode($data->hospital->name), 
                    array("hospital/view", "id"=>$data->hospital_id))',
        ),
		'fullname',
		'type',
		'phone',
        array(
            'header'=>'Менеджер',
            'value'=>'CHtml::encode($data->hospital->manager->fullname)',
        ),
	),
));
?>
