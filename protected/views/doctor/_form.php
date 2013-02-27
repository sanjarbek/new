<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'doctor-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span4','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span3','maxlength'=>20)); ?>

    <div class="control-group">
    <?php echo $form->labelEx($model, 'type', array(
        'class'=>'control-label')); ?>
        <div class="controls">
        <?php
            $this->widget('bootstrap.widgets.TbTypeahead', array(
                'model'=>$model,
                'attribute'=>'type',
                'htmlOptions'=>array(
                    'autocomplete' => 'off',
                ),
                'options'=>array(
                    'source' => $model->getTypeOptions(),
                    'items'=>4,
                    'matcher'=>"js:function(item) {
                return ~item.toLowerCase().indexOf(this.query.toLowerCase());
                }",
            )));
        ?>
        </div>
    </div>
    
    <?php echo $form->error($model, 'type'); ?>

    <?php echo $form->select2Row($model, 'hospital_id', array(
        'asDropDownList'=>true,
//        'prompt'=>'Please, select ...',
        'data'=>$model->getHospitalsList(),
        'class'=>'span5',
        'hint'=>'&nbsp;&nbsp;&nbsp;' . CHtml::link('Новая больница', '#', array(
            'onClick'=>'js: $("#new-hospital-frame").attr("src", "' .
                    Yii::app()->createUrl('hospital/create', array(
                        'asDialog'=>1,
                    )) . '");' . 
            '$("#new-hospital-dialog").dialog("open");  
            return false;',
                )),
    )); ?>

    <?php echo $form->select2Row($model, 'status', array(
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions(),
    )); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'new-hospital-dialog',
    'options'=>array(
        'title'=>'Add new hospital',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>500,
        'height'=>310,
        'class'=>'mydialogbox',
        'close'=>"js: function(event, ui) { 
            $('#new-hospital-frame').attr('src','');
            refreshHospitalsList();
            }",  
        'closeOnEscape'=>true,
    ),
    ));
    
    
?>
    <iframe id="new-hospital-frame" width="100%" height="100%" frameborder="no"></iframe>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    // here is the magic
    function refreshHospitalsList()
    {
        <?php echo CHtml::ajax(array(
            'url'=>array('doctor/gethospitalslistjson'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'success')
                {
                    $('#Doctor_hospital_id').html(data.content);
                }

            } ",
        ))?>;
        return false;
    }

</script>
