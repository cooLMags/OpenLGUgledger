<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryPostedController */
/* @var $model JournalEntryPosted */

$this->breadcrumbs=array(
	'Journal Entry Posteds'=>array('index'),
	$model->journal_id=>array('view','id'=>$model->journal_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List JournalEntryPosted', 'url'=>array('index')),
	array('label'=>'Create JournalEntryPosted', 'url'=>array('create')),
	array('label'=>'View JournalEntryPosted', 'url'=>array('view', 'id'=>$model->journal_id)),
	array('label'=>'Manage JournalEntryPosted', 'url'=>array('admin')),
);
?>

<h1>Update JournalEntryPosted <?php echo $model->journal_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>