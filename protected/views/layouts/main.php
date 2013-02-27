<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru">
<head>
	<meta charset="utf-8" />
    
    <?php echo Yii::app()->bootstrap->registerCoreCss(); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/test.css" />
</head>

<body>

<div class="container-fluid" id="page">
    <?php 
    $this->widget('bootstrap.widgets.TbNavbar', array(
        'brand' => '<strong><span class="first-part">Sema</span><span class="second-part" style="color: red">med</span></strong>',
//        'brand'=>'Semamed',
        'fixed' => 'top',
        'collapse'=>TRUE,
        'htmlOptions' => array(
//            'class'=>'navbar-inverse',
            'height'=>'50px',
        ),
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => array(
                    array('label'=>'Главная', 'url'=>array('/site/index')),
                    array('label'=>'Пациенты', 'url'=>array('/patient/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Больницы', 'url'=>array('/hospital/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Докторы', 'url'=>array('/doctor/index'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Услуги', 'url'=>array('/mrtscan/index')),
                    array('label'=>'Шаблоны', 'url'=>array('template/index'), 'visible'=>Yii::app()->user->checkAccess('Manager')),
                ),
//                'htmlOptions'=>array(
//                    'class'=>'nav nav-inner span7',
//                ),
            ),
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array('label'=>'Вход', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    array(
                        'label'=>Yii::t('title', 'Настройки'),
                        'icon'=>'icon-wrench', 
                        'visible'=>Yii::app()->user->checkAccess('Admin'),
                        'items'=>array(
                            array('label'=>Yii::t('title', 'Пациенты'), 'url'=>array('/patient/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Заказы'), 'url'=>array('/registration/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Больницы'), 'url'=>array('/hospital/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Доктора'), 'url'=>array('/doctor/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Услуги'), 'url'=>array('/mrtscan/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            '',
                            array('label'=>Yii::t('title', 'Пользователи'), 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                            array('label'=>Yii::t('title', 'Права доступа'), 'url'=>array('/rights'), 'visible'=>Yii::app()->user->checkAccess('Admin')),
                        )
                    ),
				),
                'htmlOptions'=>array(
                    'class'=>'nav pull-right',
                ),
            ),
        )
    )); ?>
    
    <br/>
    <br/>

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>

	<?php echo $content; ?>

	<div class="row-fluid">
        <div class="footer well">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </div>
	</div><!-- footer -->
    
    <?php
    if (true): ?>
    <div class="row-fluid">
        <div class=" well">
            <div class="span4">
                <?php
                $dbStats = Yii::app()->db->getStats();
                echo 'Выполнено запросов: '.$dbStats[0].
                        ' (за '.round($dbStats[1], 5).' сек)';

                ?>
            </div>
            <div class="span4">
                <?php
                $memory = round(Yii::getLogger()->memoryUsage/1024/1024, 3);
                echo 'Использовано памяти: '.$memory.' МБ';
                ?>
            </div>
            <div class="span4">
                <?php
                $time = round(Yii::getLogger()->executionTime, 3);
                echo 'Время выполнения: '.$time.' с';
                ?>
            </div>
        </div>
    </div>
    <?php endif?>

</div><!-- page -->

</body>
</html>
