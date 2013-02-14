<?php
$this->breadcrumbs=array(
	'Пациенты',
);

$this->menu=array(
	array('label'=>'Создать','url'=>array('create')),
	array('label'=>'Управлять','url'=>array('admin')),
);
?>

<div class="row-fluid">

    <?php
    $this->layout = '//layouts/column1';
//    $this->beginWidget('bootstrap.widgets.TbBox', array(
//        'title' => 'Список пациентов',
//        'headerIcon' => 'icon-th-list',
//        // when displaying a table, if we include bootstra-widget-table class
//        // the table will be 0-padding to the box
//        'htmlOptions' => array('class'=>'bootstrap-widget-table span12'),
////        'headerButtons'=>array(
////            array(
////                'class'=>'bootstrap.widgets.TbButtonGroup',
////                'size'=>'mini',
////                'buttons'=>array(
////                    array(
////                        'label'=>'Создать',
////                        'icon'=>'icon-plus',                        
////                        'url'=>array('create'),
////                    ),
////                )
////            )
////        )
//    )); 
        $this->renderPartial('_registrator_gridview', array(
            'model'=>$model,
        ));
//    $this->endWidget();
    
//    $this->beginWidget('bootstrap.widgets.TbModal', array(
//        'id'=>'myModal',
//    ));
//        $this->renderPartial('_form', array(
//            'model'=>$model,
//        ));
//    $this->endWidget();
//    
//    $this->widget('bootstrap.widgets.TbButton', array(
//        'label'=>'Click me',
//        'type'=>'primary',
//        'htmlOptions'=>array(
//        'data-toggle'=>'modal',
//        'data-target'=>'#myModal',
//        ),
//    )); 
?>
</div>

