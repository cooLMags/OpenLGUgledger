<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $model TrialBalance */

$this->breadcrumbs=array(
	'Trial Balances'=>array('index'),
	$model->trial_balance_id,
);

$this->menu=array(
	array('label'=>'List TrialBalance', 'url'=>array('index')),
	array('label'=>'Create TrialBalance', 'url'=>array('create')),
	array('label'=>'Update TrialBalance', 'url'=>array('update', 'id'=>$model->trial_balance_id)),
	array('label'=>'Delete TrialBalance', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->trial_balance_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage TrialBalance', 'url'=>array('admin')),
);
?>

<h1>View TrialBalance #<?php echo $model->trial_balance_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'trial_balance_id',
		'account_title',
		'account_code',
		'debit_balance',
		'credit_balance',
	),
)); ?>
