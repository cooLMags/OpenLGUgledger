<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsController */
/* @var $model Particulars */

$this->breadcrumbs=array(
	'Particulars'=>array('index'),
	$model->particular_id,
);

$this->menu=array(
	array('label'=>'List Particulars', 'url'=>array('index')),
	array('label'=>'Create Particulars', 'url'=>array('create')),
	array('label'=>'Update Particulars', 'url'=>array('update', 'id'=>$model->particular_id)),
	array('label'=>'Delete Particulars', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->particular_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Particulars', 'url'=>array('admin')),
);
?>

<h1>View Particulars #<?php echo $model->particular_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'particular_id',
		'journal_id',
		'date',
		'journal_page',
		'ledger_page',
		'account_title',
		'account_code',
		'pr',
		'debit',
		'credit',
	),
)); ?>
