<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryPostedController */
/* @var $model JournalEntryPosted */

$this->breadcrumbs=array(
	'Journal Entry Posteds'=>array('index'),
	$model->journal_id,
);

$this->menu=array(
	array('label'=>'List JournalEntryPosted', 'url'=>array('index')),
	array('label'=>'Create JournalEntryPosted', 'url'=>array('create')),
	array('label'=>'Update JournalEntryPosted', 'url'=>array('update', 'id'=>$model->journal_id)),
	array('label'=>'Delete JournalEntryPosted', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->journal_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage JournalEntryPosted', 'url'=>array('admin')),
);
?>

<h1>View JournalEntry Posted #<?php echo $model->journal_id; ?></h1>

<?php 
	$this->redirect(array('particularsPosted/admin','jid'=>$model->journal_id, 'jpage'=>$model->journal_page, 'status'=>$model->post_status, 'date'=>$model->date, 'comment'=>$model->comment, 'center'=>$model->responsibility_center));
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
