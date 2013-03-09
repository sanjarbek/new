<?php
/**
 * Created by JetBrains PhpStorm.
 * User: sanzhar
 * Date: 1/4/13
 * Time: 9:54 AM
 * To change this template use File | Settings | File Templates.
 */

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
//    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'post',
//    'type'=>'inline',
)); ?>
    <?php 
        echo $form->select2Row($model, 'registrator', array(
            'asDropDownList'=>true,
            'data'=>array('0'=>'Все') + User::model()->getUsersList('registrator'),
            'class'=>'span10',
        ));
    ?>

    <?php echo $form->dateRangeRow($model, 'range_date',
    array(
//        'hint'=>'Click inside! An even a date range field!.',
        'prepend'=>'<i class="icon-calendar"></i>',
        'class'=>'span10',
        'options' => array(
            'callback'=>'js:function(start, end){console.log(start.toString("MMMM d, yyyy") + " - " + end.toString("MMMM d, yyyy"));}',
            'format'=>'yyyy.MM.dd',
            'language'=>'ru',
            'ranges'=>array(
                'Сегодня'=>array('today', 'today'),
                'Вчера'=>array('yesterday', 'yesterday'),
                'Последние 7 дней'=>array('js: Date.today().add({ days: -6 })', 'today'),
                'Последние 30 дней'=>array('js: Date.today().add({ days: -29 })', 'today'),
                'Этот месяц'=>array(
                    'js: Date.today().moveToFirstDayOfMonth()',
                    'js: Date.today().moveToLastDayOfMonth()'
                ),
                'Прошлый месяц'=>array(
                    'js: Date.today().moveToFirstDayOfMonth().add({ months: -1 })',
                    'js: Date.today().moveToFirstDayOfMonth().add({ days: -1 })'
                ),
            ),
        ),
    )); ?>
    <hr />
    <?php
        echo $form->select2Row($model, 'export_type', array(
            'asDropDownList'=>true,
            'data'=>$model->getExportOptions(),
            'class'=>'span10',
        ));
    ?>
	<div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>'Показать',
    )); ?>
    </div>

<?php $this->endWidget(); ?>
