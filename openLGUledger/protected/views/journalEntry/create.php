<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryController */
/* @var $model JournalEntry */

$this->breadcrumbs=array(
	'Journal Entries'=>array('index'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List JournalEntry', 'url'=>array('index')),
	//array('label'=>'Manage JournalEntry', 'url'=>array('admin')),
);
?>

<h1>Create Journal Entry</h1>

<?php echo $this->renderPartial('_form_create', array('model'=>$model)); ?>