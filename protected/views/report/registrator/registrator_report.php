<?php
    $array_data_provider = RegistratorForm::getReport($command);
?>

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView',array(
    'id'=>'ManagerReportTable',
    'type'=>'bordered striped condensed',
    'template'=>'{items}',
    'dataProvider'=>$array_data_provider,
    'columns'=>array(
        array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
        array(
            'name'=>'patient_name',
            'header'=>'ФИО',
            'footer'=>'<strong>Сумма</strong>',
        ),
        array(
            'name'=>'patient_phone',
            'header'=>'Тел. пациента',
        ),
        array(
            'name'=>'hospital_name',
            'header'=>'Название больницы',
        ),
        array(
            'name'=>'doctor_name',
            'header'=>'ФИО доктора',
        ),
        array(
            'name'=>'doctor_phone',
            'header'=>'Тел. доктора',
        ),
        array(
            'name'=>'date',
            'header'=>'Дата регистрации',
        ),
        array(
            'name'=>'registration_count',
            'header'=>'Количество',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'total_price',
            'header'=>'Сумма',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'total_discont',
            'header'=>'Скидка',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
        array(
            'name'=>'final_price',
            'header'=>'Конечная сумма',
            'class'=>'bootstrap.widgets.TbTotalSumColumn',
        ),
    ),
));
?>