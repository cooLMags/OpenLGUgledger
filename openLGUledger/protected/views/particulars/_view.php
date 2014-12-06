<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsController */
/* @var $data Particulars */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('particular_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->particular_id), array('view', 'id'=>$data->particular_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal_id')); ?>:</b>
	<?php echo CHtml::encode($data->journal_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('journal_page')); ?>:</b>
	<?php echo CHtml::encode($data->journal_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ledger_page')); ?>:</b>
	<?php echo CHtml::encode($data->ledger_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_title')); ?>:</b>
	<?php echo CHtml::encode($data->account_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_code')); ?>:</b>
	<?php echo CHtml::encode($data->account_code); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('pr')); ?>:</b>
	<?php echo CHtml::encode($data->pr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit')); ?>:</b>
	<?php echo CHtml::encode($data->debit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit')); ?>:</b>
	<?php echo CHtml::encode($data->credit); ?>
	<br />

	*/ ?>

</div>