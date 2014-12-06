<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryController */
/* @var $model JournalEntry */

$this->breadcrumbs=array(
	'Journal Entries'=>array('index'),
	$model->journal_id,
);

$this->menu=array(
	array('label'=>'List JournalEntry', 'url'=>array('index')),
	array('label'=>'Create JournalEntry', 'url'=>array('create')),
	array('label'=>'Update JournalEntry', 'url'=>array('update', 'id'=>$model->journal_id)),
	array('label'=>'Delete JournalEntry', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->journal_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JournalEntry', 'url'=>array('admin')),
);
?>

<h1>View JournalEntry #<?php echo $model->journal_id; ?></h1>

<?php
	$this->redirect(array('particulars/admin','jid'=>$model->journal_id, 'jpage'=>$model->journal_page, 'status'=>$model->post_status, 'date'=>$model->date, 'comment'=>$model->comment, 'center'=>$model->responsibility_center));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'journal_id',
		'journal_page',
		'transaction_number',
		'date',
		'responsibility_center',
		'total_debit',
		'total_credit',
		'comment',
		'entry_type',
		'post_status',
	),
)); ?>
