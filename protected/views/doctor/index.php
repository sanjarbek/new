<?php
$this->breadcrumbs=array(
	'Doctors',
);

$this->menu=array(
	array('label'=>'Create Doctor','url'=>array('create')),
	array('label'=>'Manage Doctor','url'=>array('admin')),
);
?>

<h3>Doctors</h3>

<?php 
//$this->widget('bootstrap.widgets.TbListView',array(
//	'dataProvider'=>$dataProvider,
//	'itemView'=>'_view',
//)); ?>

<?php
$this->widget('bootstrap.widgets.TbGroupGridView',array(
	'id'=>'DoctorGrid',
	'dataProvider'=>$dataProvider,
    'type'=>'striped bordered condensed',
	'enableSorting'=>false,
    'mergeColumns'=>array('hospital_id', 'type'),
	'columns'=>array(
//		array(
//            'name'=>'id',
//            'htmlOptions'=>array(
//                'width'=>'20px',
//            ),
//        ),
        array(
            'type'=>'raw',
            'name'=>'hospital_id',
            'value'=>'CHtml::link(CHtml::encode($data->hospital->name), 
                    array("hospital/view", "id"=>$data->hospital_id))',
            'filter'=>$model->getHospitalsList(),
        ),
		'fullname',
		'type',
		'phone',
        array(
            'header'=>'Manager',
            'value'=>'CHtml::encode($data->hospital->manager->fullname)',
        ),
//		array(
//            'name'=>'status',
//            'value'=>'$data->getStatusText()',
//            'filter'=>$model->getStatusOptions(),
//        ),
		/*
		'created_at',
		'updated_at',
		'created_user',
		'updated_user',
		*/
//		array(
//			'class'=>'bootstrap.widgets.TbButtonColumn',
//		),
	),
));
?>
