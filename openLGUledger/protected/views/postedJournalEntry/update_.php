<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $model PostedJournalEntry */

$this->breadcrumbs=array(
	'Posted Journal Entries'=>array('index'),
	$model->posted_entry=>array('view','id'=>$model->posted_entry),
	'Update',
);

$this->menu=array(
	array('label'=>'List PostedJournalEntry', 'url'=>array('index')),
	array('label'=>'Create PostedJournalEntry', 'url'=>array('create')),
	array('label'=>'View PostedJournalEntry', 'url'=>array('view', 'id'=>$model->posted_entry)),
	array('label'=>'Manage PostedJournalEntry', 'url'=>array('admin')),
);
?>

<h1>Update PostedJournalEntry <?php echo $model->posted_entry; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>