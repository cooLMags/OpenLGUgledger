<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerEntriesController */
/* @var $model LedgerEntries */

$this->breadcrumbs=array(
	'Ledger Entries'=>array('index'),
	$model->ledger_entry_id,
);

$this->menu=array(
	array('label'=>'List LedgerEntries', 'url'=>array('index')),
	array('label'=>'Create LedgerEntries', 'url'=>array('create')),
	array('label'=>'Update LedgerEntries', 'url'=>array('update', 'id'=>$model->ledger_entry_id)),
	array('label'=>'Delete LedgerEntries', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ledger_entry_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LedgerEntries', 'url'=>array('admin')),
);
?>

<h1>View LedgerEntries #<?php echo $model->ledger_entry_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ledger_entry_id',
		'particular_id',
		'date',
		'account_title',
		'account_code',
		'journal_page',
		'ledger_page',
		'debit',
		'credit',
	),
)); ?>
