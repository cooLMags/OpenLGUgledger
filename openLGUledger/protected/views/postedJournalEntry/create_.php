<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $model PostedJournalEntry */

$this->breadcrumbs=array(
	'Posted Journal Entries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PostedJournalEntry', 'url'=>array('index')),
	array('label'=>'Manage PostedJournalEntry', 'url'=>array('admin')),
);
?>

<h1>Create PostedJournalEntry</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>