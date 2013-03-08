<?php
$this->breadcrumbs=array(
	'Отчеты'=>array('registrator'),
	'Отчет регистратора',
);
?>

<div class="row-fluid">
    <div class="span3">
        <div class="well-small">
        <?php 
            echo $this->renderPartial('registrator/_search_form', array(
                'model'=>$model,
            )); 
        ?>
        </div>
    </div>
    <div class="span9">
        <?php
            if (isset($command))
            {
                echo $this->renderPartial('registrator/registrator_report', array(
                    'command'=>$command,
                ));
            }
        ?>        
    </div>
</div>
