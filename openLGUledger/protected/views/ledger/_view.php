<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerController */
/* @var $data Ledger */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_code')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->account_code), array('view', 'id'=>$data->account_code)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_title')); ?>:</b>
	<?php echo CHtml::encode($data->account_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ledger_page')); ?>:</b>
	<?php echo CHtml::encode($data->ledger_page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('major_account_title')); ?>:</b>
	<?php echo CHtml::encode($data->major_account_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('normal_balance')); ?>:</b>
	<?php echo CHtml::encode($data->normal_balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit')); ?>:</b>
	<?php echo CHtml::encode($data->debit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit')); ?>:</b>
	<?php echo CHtml::encode($data->credit); ?>
	<br />


</div>