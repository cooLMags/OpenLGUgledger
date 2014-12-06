<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $data TrialBalance */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('trial_balance_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->trial_balance_id), array('view', 'id'=>$data->trial_balance_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_title')); ?>:</b>
	<?php echo CHtml::encode($data->account_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('account_code')); ?>:</b>
	<?php echo CHtml::encode($data->account_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('debit_balance')); ?>:</b>
	<?php echo CHtml::encode($data->debit_balance); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('credit_balance')); ?>:</b>
	<?php echo CHtml::encode($data->credit_balance); ?>
	<br />


</div>