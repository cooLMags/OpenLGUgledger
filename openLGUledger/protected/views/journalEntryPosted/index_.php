<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryPostedController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Journal Entry Posteds',
);

$this->menu=array(
	array('label'=>'Create JournalEntryPosted', 'url'=>array('create')),
	array('label'=>'Manage JournalEntryPosted', 'url'=>array('admin')),
);
?>

<h1>Journal Entry Posteds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
