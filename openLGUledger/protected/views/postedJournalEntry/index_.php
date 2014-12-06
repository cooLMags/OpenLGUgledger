<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Posted Journal Entries',
);

$this->menu=array(
	array('label'=>'Create PostedJournalEntry', 'url'=>array('create')),
	array('label'=>'Manage PostedJournalEntry', 'url'=>array('admin')),
);
?>

<h1>Posted Journal Entries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
