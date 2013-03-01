<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <?php // echo Yii::app()->bootstrap->registerCoreCss(); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/test.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/iframe.css" />
    
</head>

<body>

<div>

	<?php echo $content; ?>

</div><!-- page -->
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
</body>
</html>
