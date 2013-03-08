<?php
$this->breadcrumbs=array(
	'Отчеты'=>array('/report'),
	'Отчет регистратора',
);
?>

<div class="row-fluid">
    <div class="span3">
        <div class="well-small">
        <?php 
            echo $this->renderPartial('_search_form', array(
                'model'=>$model,
            )); 
        ?>
        </div>
    </div>
    <div class="span9">
        <?php
            if (isset($command))
            {
                echo $this->renderPartial('registrator_report', array(
                    'command'=>$command,
                ));
            }
        ?>        
    </div>
</div>
