<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $model TrialBalance */

$this->breadcrumbs=array(
	'Trial Balances'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TrialBalance', 'url'=>array('index')),
	array('label'=>'Manage TrialBalance', 'url'=>array('admin')),
);
?>

<h1>Create TrialBalance</h1>

<?php echo $this->renderPartial('_form_create', array('model'=>$model)); ?>