<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'patient-form',
    'action'=>array('patient/create'),
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
//        'class'=>'well',
    )
)); ?>
    
	<!--<p class="help-block">Fields with <span class="required">*</span> are required.</p>-->
    <p />
	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'fullname',array('class'=>'span5','maxlength'=>30)); ?>

	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span3','maxlength'=>20)); ?>

	<?php echo $form->datepickerRow($model,'birthday',array(
        'class'=>'span5', 
        'prepend'=>'<i class="icon-calendar"></i>',
        'options'=>array(
            'format'=>'yyyy-mm-dd',
            'calendarWeeks'=>true,
            'startView'=>'decade',
        ),
    )); ?>
    <?php echo $form->select2Row($model, 'sex', array(
        'asDropDownList'=>true,
        'data'=>$model->getSexOptions(),
    )); ?>
    
    <?php echo $form->select2Row($model, 'doctor_id', array(
        'asDropDownList'=>true,
        'data'=>$model->getDoctorsList(),
        'class'=>'span4',
    )); ?>
    
    <?php 
        echo CHtml::link('Add new doctor', '#', array(
            'onClick'=>'js: $("#new-doctor-frame").attr("src", "' .
                    Yii::app()->createUrl('doctor/create', array(
                        'asDialog'=>1,
                    )) . '");' . 
            '$("#new-doctor-dialog").dialog("open");  
            return false;',
                ))
    ?>
    
    <?php echo $form->select2Row($model, 'status', array(
        'asDropDownList'=>true,
        'data'=>$model->getStatusOptions(),
//        'options'=>array(
//                    'width'=>'200px',
//        )
    )); ?>
    
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
            'htmlOptions'=>array(
                'class'=>'pull-right',
            )
		)); ?>
	</div>

<?php $this->endWidget(); ?>

    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'new-doctor-dialog',
    'options'=>array(
        'title'=>'Add new doctor',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>500,
        'height'=>310,
        'class'=>'mydialogbox',
        'close'=>"js: function(event, ui) { 
            window.parent.$('#new-doctor-frame').attr('src','');
            refreshDoctorsList();
            }",  
        'closeOnEscape'=>true,
    ),
    ));
    
    
?>
<iframe id="new-doctor-frame" width="100%" height="100%" frameborder="no"></iframe>
<?php $this->endWidget(); ?>

<script type="text/javascript">
    // here is the magic
    function refreshDoctorsList()
    {
        <?php echo CHtml::ajax(array(
            'url'=>array('patient/getdoctorslistjson'),
            'type'=>'post',
            'dataType'=>'json',
            'success'=>"function(data)
            {
                if (data.status == 'success')
                {
                    $('#Patient_doctor_id').html(data.content);
                }

            } ",
        ))?>;
        return false;
    }

</script>
