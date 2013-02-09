<?php
$this->breadcrumbs=array(
	'Patients'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Patient','url'=>array('index')),
	array('label'=>'Create Patient','url'=>array('create')),
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
        $this->renderPartial('_gridview', array(
            'model'=>$model
        )); 

    $this->endWidget();

    ?>
</div>

<?php
//--------------------- begin new code --------------------------
   // add the (closed) dialog for the iframe
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'cru-dialog',
    'options'=>array(
        'title'=>'Detail view',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>400,
        'height'=>330,
        'class'=>'mydialogbox',
        'close'=>"js: function(event, ui) { window.parent.$('#cru-frame').attr('src',''); }",  
        'closeOnEscape'=>true,
    ),
    ));
?>
<iframe id="cru-frame" width="100%" height="100%" frameborder="no"></iframe>
<?php 
//Yii::app()->clientScript->registerScript('onDialogBoxClose', "
//    $('#cru-dialog').hide(function(event, ui) {
//        $('#cru-frame').attr('src','')
//    });
//"
//);
 
$this->endWidget();
//--------------------- end new code --------------------------
?>