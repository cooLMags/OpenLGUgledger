<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryPostedController */
/* @var $model JournalEntryPosted */

$this->breadcrumbs=array(
	'Journal Entry Posteds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List JournalEntryPosted', 'url'=>array('index')),
	array('label'=>'Manage JournalEntryPosted', 'url'=>array('admin')),
);
?>

<h1>Create JournalEntryPosted</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>