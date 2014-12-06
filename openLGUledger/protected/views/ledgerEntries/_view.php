<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerEntriesController */
/* @var $data LedgerEntries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ledger_entry_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ledger_entry_id), array('view', 'id'=>$data->ledger_entry_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('particular_id')); ?>:</b>
	<?php echo CHtml::encode($data->particular_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_title')); ?>:</b>
	<?php echo CHtml::encode($data->account_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_code')); ?>:</b>
	<?php echo CHtml::encode($data->account_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal_page')); ?>:</b>
	<?php echo CHtml::encode($data->journal_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ledger_page')); ?>:</b>
	<?php echo CHtml::encode($data->ledger_page); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('debit')); ?>:</b>
	<?php echo CHtml::encode($data->debit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit')); ?>:</b>
	<?php echo CHtml::encode($data->credit); ?>
	<br />

	*/ ?>

</div>