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
    
    if (Yii::app()->user->checkAccess('Registrator'))
    {
        $this->renderPartial('_registrator_gridview', array(
            'model'=>$model,
        ));
    }
    else if (Yii::app()->user->checkAccess('Doctor'))
    {
        $this->renderPartial('_doctor_gridview', array(
            'model'=>$model,
        ));
    }
    
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

