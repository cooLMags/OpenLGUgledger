<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsPostedController */
/* @var $model ParticularsPosted */

$this->breadcrumbs=array(
	'Particulars Posteds'=>array('index'),
	$model->particular_id,
);

$this->menu=array(
	array('label'=>'List ParticularsPosted', 'url'=>array('index')),
	array('label'=>'Create ParticularsPosted', 'url'=>array('create')),
	array('label'=>'Update ParticularsPosted', 'url'=>array('update', 'id'=>$model->particular_id)),
	array('label'=>'Delete ParticularsPosted', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->particular_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ParticularsPosted', 'url'=>array('admin')),
);
?>

<h1>View ParticularsPosted #<?php echo $model->particular_id; ?></h1>

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
