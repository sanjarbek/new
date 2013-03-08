<?php

if (isset($patient))
{
    $show_discont = ($patient->status==Patient::STATUS_NOT_FINISHED) ? true : false;
}

$this->widget('bootstrap.widgets.TbExtendedGridView',array(
	'id'=>'RegistrationGridRegistrator',
	'dataProvider'=>$model->with('mrtscan', 'conclus')->search(),
//	'filter'=>$model,
    'enableSorting'=>false,
    'ajaxUrl'=> Yii::app()->createUrl('registration/patientRegistrations', array('pid'=>$model->patient_id)),
    'type'=>'bordered condensed hover',
    'template'=>'{items}',
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
            'class'=>'bootstrap.widgets.TbEditableColumn',
            'name'=>'discont',
            'visible'=>$show_discont,
            'editable' => array(
                'title'=>'Введите сумму скидки',
                'url' => $this->createUrl('/registration/save'),
				'placement' => 'top',
                'options'=>array(
                    'success' => 'js: function() {
                        $.fn.yiiGridView.update("RegistrationGridRegistrator");
                    }',
                ),
//				'inputclass' => 'span4',
            )
        ),
        array(
            'name'=>'discont',
            'visible'=>!$show_discont,
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
            'visible'=>$show_discont,
            'buttons'=>array(    
                'delete'=>array(
                    'url'=>'$this->grid->controller->createUrl("/registration/delete", array("id"=>$data->primaryKey))',
                ),                    
            ),
		),
	),
));
?>
