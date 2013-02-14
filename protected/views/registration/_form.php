<?php
$cs = Yii::app()->getClientScript();
$cs->registerScript(
    'getMrtscanPrice',
    "$('#Registration_mrtscan_id').bind('change',function(){getMrtscanPrice();});
    $('#Registration_discont').bind('change',function(){
        getMrtscanPrice();
        });
    ",
    CClientScript::POS_END
);
?>

<script type="text/javascript">

    $(document).ready(getMrtscanPrice)
    
    function getMrtscanPrice()
    {
        <?php echo CHtml::ajax(array(
            'url'=>array('mrtscan/getPrice'),
            'data'=> "js:$('#Registration_mrtscan_id').serialize()",
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'failure')
                {
                    //alert('Please, check your internet connection.');
                }
                else
                {
                    var discont = parseInt($('#Registration_discont').val());
                    if (isNaN(discont))
                    {
                        $('#Registration_discont').val(0);
                        discont = 0;
                    }
                    var mrtscan_price = parseInt(data.content);
                    $('#Registration_price').val(mrtscan_price);
                    $('#Registration_price_with_discont').val(mrtscan_price-discont);
                }

            } ",
        ))?>;
        return false;
    }

</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'registration-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->select2Row($model,'mrtscan_id', array(
        'asDropDownList'=>true,
        'data'=>$model->getNotYetSelectedMrtscansListData($patient),
    )); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span2','maxlength'=>10, 'readonly'=>true)); ?>

	<?php echo $form->textFieldRow($model,'discont',array('class'=>'span2','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'price_with_discont',array('class'=>'span2','maxlength'=>10, 'readonly'=>true)); ?>

	<?php echo $form->select2Row($model,'status', array(
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions()
    )); ?>

	<?php // echo $form->textFieldRow($model,'report_status',array('class'=>'span5')); ?>

	<?php // echo $form->textAreaRow($model,'report_text',array('rows'=>6, 'cols'=>30, 'class'=>'span4')); ?>
    
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
