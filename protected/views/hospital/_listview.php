<?php
    $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'HospitalsList',
    'dataProvider'=>$dataProvider,
    'type'=>'bordered striped condensed',
    'pagerCssClass'=>'pagination pagination-mini pagination-centered',
    'responsiveTable'=>FALSE,
    'enableSorting'=>FALSE,
    'columns'=>array(
        array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
        'name',
        'phone',
        array(
            'type'=>'raw',
            'name'=>'manager_id',
            'value'=>'CHtml::link(CHtml::encode($data->manager->fullname),
                array("user/view", "id"=>$data->manager_id))',
        ),
    ),
)); 

?>