<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $data PostedJournalEntry */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('posted_entry')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->posted_entry), array('view', 'id'=>$data->posted_entry)); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
	<?php echo CHtml::encode($data->year); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('month')); ?>:</b>
	<?php echo CHtml::encode($data->month); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('day')); ?>:</b>
	<?php echo CHtml::encode($data->day); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('responsibility_center')); ?>:</b>
	<?php echo CHtml::encode($data->responsibility_center); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_debit')); ?>:</b>
	<?php echo CHtml::encode($data->total_debit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total_credit')); ?>:</b>
	<?php echo CHtml::encode($data->total_credit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('entry_type')); ?>:</b>
	<?php echo CHtml::encode($data->entry_type); ?>
	<br />

	*/ ?>

</div>