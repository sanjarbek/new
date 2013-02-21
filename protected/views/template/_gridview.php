<?php 
$href = Yii::getPathOfAlias('uploads.templates');

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'TemplateGrid',
    'type'=>'bordered condensed striped',
	'dataProvider'=>Yii::app()->user->checkAccess('Admin') ? $model->search() : $model->my()->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
        array(
            'name'=>'owner_id',
            'value'=>'CHtml::encode($data->owner->fullname)',
        ),
        array(
            'type'=>'raw',
            'name'=>'name',            
//            'value'=>'<a href="'.$href.'/$data->file">$data->name</a>',
            'value'=>'CHtml::link($data->name, $data->downloadfilepath."/".$data->file)',
        ),
		'description',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); 
?>