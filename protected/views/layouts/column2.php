<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
	<div class="span9">
        <?php if(Yii::app()->user->hasFlash('success')):?>
            <div class="row-fluid">
            <?php
            $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>false, // use transitions?
                'closeText'=>'x', // close link text - if set to false, no close link is displayed
                'htmlOptions'=>array(
                    'class'=>'span12',
                ),
                'alerts'=>array( // configurations per alert type
                    'success'=>array(
                        'block'=>true, 
                        'fade'=>true, 
                        'closeText'=>'x',
                    ), // success, info, warning, error or danger
                ),
            ));
            ?>
            </div>
        <?php endif; ?>
        
		<?php echo $content; ?>
	</div><!-- content -->
    <div class="span3">
<!--        <div class="row-fluid">
            <div class="span12">
            <?php
//                $this->beginWidget('bootstrap.widgets.TbBox', array(
//                    'title'=>'Operations',
//                ));
//                $this->widget('bootstrap.widgets.TbMenu', array(
//                    'items'=>$this->menu,
//                    'type'=>'list',
//                    'htmlOptions'=>array(
//                        'class'=>'operations',
//                    ),
//                ));
//                $this->endWidget();
            ?>
            </div>
        </div>-->
        <div class="row-fluid">
            <div class="span12">
            <?php
            $operations = array(array('label'=>'Функции', 'itemOptions'=>array('class'=>'nav-header'))); 
            $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'htmlOptions'=>array(
                    'class'=>'well',
                ),
                'items' => array_merge($operations, $this->menu),
//                array(
//                    array('label'=>'Operations', 'itemOptions'=>array('class'=>'nav-header')),
//                    array('label'=>'Home', 'url'=>'#', 'itemOptions'=>array('class'=>'active')),
//                    array('label'=>'Library', 'url'=>'#'),
//                    array('label'=>'Applications', 'url'=>'#'),
//                    array('label'=>'Another list header', 'itemOptions'=>array('class'=>'nav-header')),
//                    array('label'=>'Profile', 'url'=>'#'),
//                    array('label'=>'Settings', 'url'=>'#'),
//                    '',
//                    array('label'=>'Help', 'url'=>'#'),
//                    )
                ));
            ?>
            </div>
        </div>
    </div><!-- sidebar -->
</div>

<?php $this->endContent(); ?>