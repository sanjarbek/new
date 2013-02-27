<?php 
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'MrtscansList',
	'dataProvider'=>$dataProvider,
    'type'=>'bordered condensed striped',
    'template'=>'{summary}{items}{pager}',
    'enableSorting'=>false,
    'columns'=>array(
        array(
            'name'=>'№',
            'type'=>'raw',
            'value'=>'$this->grid->dataProvider->pagination->currentPage*$this->grid->dataProvider->pagination->pageSize + $row+1',
        ),
        'name',
        'description',
        'price',
    )
)); ?>
