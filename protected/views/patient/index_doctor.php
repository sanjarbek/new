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
    
    $this->renderPartial('_gridview_doctor', array(
        'model'=>$model,
    ));
    
    $this->beginWidget('bootstrap.widgets.TbModal', array(
        'id'=>'myModal',
    ));
?>
    <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
    <h4>Подробнее ...</h4>
    </div>
 
    <div class="modal-body">
    <iframe id="doctor_details_frame" width="100%" height="100%" frameborder="no"></iframe>
    </div>
 

    <div class="modal-footer">
    <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>'Close',
            'type'=>'primary',
            'url'=>'#',
            'htmlOptions'=>array(
                'data-dismiss'=>'modal'
            ),
        ));
    ?>
    </div>
<?php
    $this->endWidget();
?>
</div>

