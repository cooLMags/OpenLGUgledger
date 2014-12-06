<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerController */
/* @var $model Ledger */

$this->breadcrumbs=array(
	'Ledgers'=>array('index'),
	$model->account_code,
);

$this->menu=array(
	array('label'=>'List Ledger', 'url'=>array('index')),
	array('label'=>'Create Ledger', 'url'=>array('create')),
	array('label'=>'Update Ledger', 'url'=>array('update', 'id'=>$model->account_code)),
	array('label'=>'Delete Ledger', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->account_code),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ledger', 'url'=>array('admin')),
);
?>

<h1>View Ledger #<?php echo $model->account_code; ?></h1>

<?php
	$this->redirect(array('ledgerEntries/admin','lpage'=>$model->ledger_page, 'ltitle'=>$model->account_title, 'lcode'=>$model->account_code));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'account_code',
		'account_title',
		'ledger_page',
		'major_account_title',
		'normal_balance',
		'debit',
		'credit',
	),
)); ?>
