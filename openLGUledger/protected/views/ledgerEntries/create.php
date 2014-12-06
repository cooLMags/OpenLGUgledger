<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerEntriesController */
/* @var $model LedgerEntries */

$this->breadcrumbs=array(
	'Ledger Entries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LedgerEntries', 'url'=>array('index')),
	array('label'=>'Manage LedgerEntries', 'url'=>array('admin')),
);
?>

<h1>Create LedgerEntries</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>