<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $model TrialBalance */

$this->breadcrumbs=array(
	'Trial Balances'=>array('index'),
	$model->trial_balance_id=>array('view','id'=>$model->trial_balance_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TrialBalance', 'url'=>array('index')),
	array('label'=>'Create TrialBalance', 'url'=>array('create')),
	array('label'=>'View TrialBalance', 'url'=>array('view', 'id'=>$model->trial_balance_id)),
	array('label'=>'Manage TrialBalance', 'url'=>array('admin')),
);
?>

<h1>Update TrialBalance <?php echo $model->trial_balance_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>