<?php
    $array_data_provider = ManagerForm::getDoctorsPerMonth($command);
?>

<?php

$columns = array(
    array(
        'name'=>'hospital',
        'header'=>'Больница',
    ),
    array(
        'name'=>'doctor',
        'header'=>'Доктор',
        'footer'=>'<strong>Сумма</strong>',
    ),
);

$columns[]=array(
            'name'=>'1',
            'header'=>'<div class="vertical">Январь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'2',
            'header'=>'<div class="vertical">Февраль</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'3',
            'header'=>'<div class="vertical">Март</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'4',
            'header'=>'<div class="vertical">Апрель</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'5',
            'header'=>'<div class="vertical">Май</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'6',
            'header'=>'<div class="vertical">Июнь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'7',
            'header'=>'<div class="vertical">Июль</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'8',
            'header'=>'<div class="vertical">Август</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'9',
            'header'=>'<div class="vertical">Сентябрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'10',
            'header'=>'<div class="vertical">Октябрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'11',
            'header'=>'<div class="vertical">Ноябрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$columns[]=array(
            'name'=>'12',
            'header'=>'<div class="vertical">Декабрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );

$columns[] = array(
            'name'=>'sum',
            'header'=>'Сумма',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
$this->widget('bootstrap.widgets.TbExtendedGridView',array(
    'id'=>'ManagerReportTable',
    'type'=>'bordered striped condensed',
    'template'=>'{items}',
    'dataProvider'=>$array_data_provider,
    'columns'=>$columns,
));
?>