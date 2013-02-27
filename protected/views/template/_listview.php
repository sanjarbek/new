<?php
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'TemplateList',
    'type'=>'bordered condensed striped',
	'dataProvider'=>$dataProvider,
    'enableSorting'=>false,
	'columns'=>array(
		array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
        array(
            'name'=>'owner_id',
            'value'=>'CHtml::encode($data->owner->fullname)',
        ),
        array(
            'type'=>'raw',
            'name'=>'name',
            'value'=>'CHtml::link($data->name, $data->downloadfilepath."/".$data->file)',
        ),
		'description',
	),
)); 
?>

