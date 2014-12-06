<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailMonthController */
/* @var $data AuditTrailMonth */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('audit_trail_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->audit_trail_id), array('view', 'id'=>$data->audit_trail_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('amount_involved')); ?>:</b>
	<?php echo CHtml::encode($data->amount_involved); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activity')); ?>:</b>
	<?php echo CHtml::encode($data->activity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />


</div>