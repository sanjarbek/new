<?php

$this->breadcrumbs=array(
    'Отчеты'=>array('/report'),
	'Отчет менеджера',
);
?>

<div class="row-fluid">
    <div class="span3">
        <div class="well-small">
        <?php 
            echo $this->renderPartial('_form', array(
                'model'=>$model,
            )); 
        ?>
        </div>
    </div>
    <div class="span9">
        <?php // echo $sql; ?>
        <?php 
        if ($view == 1)
        {
            echo $this->renderPartial('hospitals_per_month_day', array(
                'command'=>$command,
                'days_count'=>$days_count,
            )); 
        }
        else if ($view == 2)
        {
            echo $this->renderPartial('hospitals_per_month', array(
                'command'=>$command,
            )); 
        }
        else if ($view==3)
        {
            echo $this->renderPartial('doctors_per_month_day', array(
                'command'=>$command,
                'days_count'=>$days_count,
            ));
        }
        else if ($view==4)
        {
            echo $this->renderPartial('doctors_per_month', array(
                'command'=>$command,
            ));
        }
        ?>
    </div>
</div>
