<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $model PostedJournalEntry */

$this->breadcrumbs=array(
	'Posted Journal Entries'=>array('index'),
	$model->posted_entry,
);

$this->menu=array(
	array('label'=>'List PostedJournalEntry', 'url'=>array('index')),
	array('label'=>'Create PostedJournalEntry', 'url'=>array('create')),
	array('label'=>'Update PostedJournalEntry', 'url'=>array('update', 'id'=>$model->posted_entry)),
	array('label'=>'Delete PostedJournalEntry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->posted_entry),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PostedJournalEntry', 'url'=>array('admin')),
);
?>

<h1>View PostedJournalEntry #<?php echo $model->posted_entry; ?></h1>

<?php
//redirect
$this->redirect(array('particularsPosted/admin', 'jpage'=>$model->journal_page, 'status'=>1, 'date'=>$model->date, 'comment'=>$model->comment, 'center'=>$model->responsibility_center));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'posted_entry',
		'journal_page',
		'transaction_number',
		'date',
		'year',
		'month',
		'day',
		'responsibility_center',
		'total_debit',
		'total_credit',
		'comment',
		'entry_type',
	),
)); ?>
