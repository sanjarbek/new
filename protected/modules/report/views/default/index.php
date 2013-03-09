<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	'Отчеты',
);
?>
<h4>Отчеты</h4>
<ul>
    <li><?php echo CHtml::link('Отчеты менеджера', array('/report/manager')); ?></li>
    <li><?php echo CHtml::link('Отчеты регистратора', array('/report/registrator')); ?></li>
</ul>