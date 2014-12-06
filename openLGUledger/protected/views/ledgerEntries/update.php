<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerEntriesController */
/* @var $model LedgerEntries */

$this->breadcrumbs=array(
	'Ledger Entries'=>array('index'),
	$model->ledger_entry_id=>array('view','id'=>$model->ledger_entry_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List LedgerEntries', 'url'=>array('index')),
	array('label'=>'Create LedgerEntries', 'url'=>array('create')),
	array('label'=>'View LedgerEntries', 'url'=>array('view', 'id'=>$model->ledger_entry_id)),
	array('label'=>'Manage LedgerEntries', 'url'=>array('admin')),
);
?>

<h1>Update LedgerEntries <?php echo $model->ledger_entry_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>