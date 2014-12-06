<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerEntriesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ledger Entries',
);

$this->menu=array(
	array('label'=>'Create LedgerEntries', 'url'=>array('create')),
	array('label'=>'Manage LedgerEntries', 'url'=>array('admin')),
);
?>

<h1>Ledger Entries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
