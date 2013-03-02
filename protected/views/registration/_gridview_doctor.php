<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'RegistrationGridDoctor',
	'dataProvider'=>$model->with('mrtscan', 'conclus')->search(),
    'enableSorting'=>false,
    'type'=>'bordered condensed striped',
    'template'=>'{items}',
    'ajaxUrl' => Yii::app()->createUrl('registration/patientRegistrations', array('pid'=>$model->patient_id)),
	'columns'=>array(
		array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
        array(
            'name'=>'id',
            'htmlOptions'=>array(
                'width'=>'40',
            )
        ),
		array(
            'name'=>'mrtscan_id',
            'value'=>'CHtml::encode($data->mrtscan->name)',
        ),
        array(
            'type'=>'raw',
            'header'=>'Шаблон',
            'value'=>'"<span class=\"icon-download\"></span>"',
        ),
        array(
            'type'=>'raw',
            'header'=>'Заключение',
            'value'=>'$data->conclus==null ?
                CHtml::link("Загрузить", "#myModal", array("onClick"=>"js: $(\"#conclusion_upload_frame\").attr(\"src\", \"".Yii::app()->createUrl("/conclusion/create", array(
                        "rid"=>$data->id,
                        "asDialog"=>1,
                    ))."\")", "data-toggle"=>"modal")) :
                CHtml::link("Скачать", $data->conclus->downloadfilepath.DIRECTORY_SEPARATOR.$data->conclus->file);',
        ),
        array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'visible'=>'$data->conclus!=null',
                    'url'=>'$this->grid->controller->createUrl("//conclusion/delete", array("id"=>$data->conclus->id))',
//                    'url'=>'$this->grid->controller->createUrl("//conclusion/delete")',
                ),
            ),
		),
	),
));
?>
