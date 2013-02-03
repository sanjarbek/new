<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('patient_id')); ?>:</b>
	<?php echo CHtml::encode($data->patient->fullname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mrtscan_id')); ?>:</b>
	<?php echo CHtml::encode($data->mrtscan->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discont')); ?>:</b>
	<?php echo CHtml::encode($data->discont); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_with_discont')); ?>:</b>
	<?php echo CHtml::encode($data->price_with_discont); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->getStatusText()); ?>
	<br />
    
    <hr />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('report_status')); ?>:</b>
	<?php echo CHtml::encode($data->report_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('report_text')); ?>:</b>
	<?php echo CHtml::encode($data->report_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_at')); ?>:</b>
	<?php echo CHtml::encode($data->updated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_user')); ?>:</b>
	<?php echo CHtml::encode($data->created_user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updated_user')); ?>:</b>
	<?php echo CHtml::encode($data->updated_user); ?>
	<br />

	*/ ?>

</div>