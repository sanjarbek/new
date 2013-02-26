<?php
    $array_data_provider = ManagerForm::getDoctorsPerMonthDay($command, $days_count);
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
    )
);

for($i = 1; $i<=$days_count; $i++)
{
    $columns[] = array(
            'name'=>(string)$i,
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        );
}

$columns[] =  array(
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