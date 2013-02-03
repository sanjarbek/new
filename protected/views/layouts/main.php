<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<!--<link rel="stylesheet" type="text/css" href="<?php // echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />-->
	<!--<link rel="stylesheet" type="text/css" href="<?php // echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php // echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<!--<link rel="stylesheet" type="text/css" href="<?php // echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
    <?php echo Yii::app()->bootstrap->registerCoreCss(); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/test.css" />
</head>

<body>

<div class="container-fluid" id="page">
    <?php 
    $this->widget('bootstrap.widgets.TbNavbar', array(
        'brand' => 'Title',
        'fixed' => 'true',
        'htmlOptions' => array(
            'class'=>'navbar-inverse',
        ),
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => array(
                    array('label'=>'Home', 'url'=>array('/site/index')),
                    array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                    array('label'=>'Contact', 'url'=>array('/site/contact')),
                    array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/user/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            ),
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items'=>array(
                    array(
                        'label'=>Yii::t('title', 'Configure'),
                        'icon'=>'icon-wrench', 
                        'items'=>array(
                            array('label'=>Yii::t('title', 'Patients'), 'url'=>array('/patient/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Registrations'), 'url'=>array('/registration/admin'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Hospitals'), 'url'=>array('/hospital'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'Doctors'), 'url'=>array('/doctor'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>Yii::t('title', 'MRT scans'), 'url'=>array('/mrtscan'), 'visible'=>!Yii::app()->user->isGuest),
                        )
                    ),
				),
                'htmlOptions'=>array(
                    'class'=>'nav pull-right',
                ),
            ),
        )
    )); ?>

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

</div><!-- page -->

</body>
</html>
