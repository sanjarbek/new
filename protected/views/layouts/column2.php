<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
	<div class="span10">
		<?php echo $content; ?>
	</div><!-- content -->
    <div class="span2">
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
    </div><!-- sidebar -->
</div>

<?php $this->endContent(); ?>