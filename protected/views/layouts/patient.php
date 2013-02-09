<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="span2">
        <div class="row-fluid">
        <?php
            $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title'=>'Operations',
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array(
                    'class'=>'operations',
                ),
            ));
            $this->endWidget();
        ?>
        </div>
    </div><!-- sidebar -->
	<div class="span10">
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
        <div class="row-fluid">
            <?php echo $content; ?>
        </div>
	</div><!-- content -->
    
</div>

<?php $this->endContent(); ?>