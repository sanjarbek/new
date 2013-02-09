<?php
$this->breadcrumbs=array(
	'Patients',
);

$this->menu=array(
	array('label'=>'Create Patient','url'=>array('create')),
	array('label'=>'Manage Patient','url'=>array('admin')),
);
?>

<div class="row-fluid">

    <?php 
    $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Manage patients',
        'headerIcon' => 'icon-th-list',
        // when displaying a table, if we include bootstra-widget-table class
        // the table will be 0-padding to the box
        'htmlOptions' => array('class'=>'bootstrap-widget-table span12')
    )); 
        $this->renderPartial('_registrator_gridview', array(
            'model'=>$model,
        ));
    $this->endWidget();
?>
</div>

