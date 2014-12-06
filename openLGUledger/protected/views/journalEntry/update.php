<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryController */
/* @var $model JournalEntry */

$this->breadcrumbs=array(
	'Journal Entries'=>array('admin'),
	$model->journal_page,
	'Update',
);

$this->menu=array(
	array('label'=>'List JournalEntry', 'url'=>array('index')),
	array('label'=>'Create JournalEntry', 'url'=>array('create')),
	array('label'=>'View JournalEntry', 'url'=>array('view', 'id'=>$model->journal_id)),
	array('label'=>'Manage JournalEntry', 'url'=>array('admin')),
);
?>

<h1>Update Journal Entry <?php echo $model->journal_page; ?></h1>

<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>