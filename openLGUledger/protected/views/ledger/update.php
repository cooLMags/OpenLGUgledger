<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerController */
/* @var $model Ledger */

$this->breadcrumbs=array(
	'Ledgers'=>array('admin'),
	$model->account_code=>array('view','id'=>$model->account_code),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Ledger', 'url'=>array('index')),
	//array('label'=>'Create Ledger', 'url'=>array('create')),
	//array('label'=>'View Ledger', 'url'=>array('view', 'id'=>$model->account_code)),
	//array('label'=>'Manage Ledger', 'url'=>array('admin')),
);
?>

<h1>Update Ledger Account <?php echo $model->account_code; ?></h1>

<?php echo $this->renderPartial('_form_create', array('model'=>$model)); ?>