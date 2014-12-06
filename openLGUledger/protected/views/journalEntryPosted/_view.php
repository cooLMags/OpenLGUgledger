<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryPostedController */
/* @var $data JournalEntryPosted */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->journal_id), array('view', 'id'=>$data->journal_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal_page')); ?>:</b>
	<?php echo CHtml::encode($data->journal_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('transaction_number')); ?>:</b>
	<?php echo CHtml::encode($data->transaction_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('responsibility_center')); ?>:</b>
	<?php echo CHtml::encode($data->responsibility_center); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_debit')); ?>:</b>
	<?php echo CHtml::encode($data->total_debit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_credit')); ?>:</b>
	<?php echo CHtml::encode($data->total_credit); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entry_type')); ?>:</b>
	<?php echo CHtml::encode($data->entry_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('post_status')); ?>:</b>
	<?php echo CHtml::encode($data->post_status); ?>
	<br />

	*/ ?>

</div>