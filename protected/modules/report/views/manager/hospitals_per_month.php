<?php
    $array_data_provider = ManagerForm::getHospitalsPerMonth($command);
?>

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView',array(
    'id'=>'ManagerReportTable',
    'type'=>'bordered striped condensed',
    'template'=>'{items}',
    'dataProvider'=>$array_data_provider,
    'columns'=>array(
        array(
            'name'=>'hospital',
            'header'=>'Больница',
            'footer'=>'<strong>Сумма</strong>',
        ),
        array(
            'name'=>'January',
            'header'=>'<div class="vertical">Январь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'February',
            'header'=>'<div class="vertical">Февраль</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'March',
            'header'=>'<div class="vertical">Март</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'April',
            'header'=>'<div class="vertical">Апрель</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'May',
            'header'=>'<div class="vertical">Май</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'June',
            'header'=>'<div class="vertical">Июнь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'July',
            'header'=>'<div class="vertical">Июль</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'August',
            'header'=>'<div class="vertical">Август</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'September',
            'header'=>'<div class="vertical">Сентябрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'October',
            'header'=>'<div class="vertical">Октябрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'November',
            'header'=>'<div class="vertical">Ноябрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'December',
            'header'=>'<div class="vertical">Декабрь</div>',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'sum',
            'header'=>'Сумма',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
    ),
));
?>