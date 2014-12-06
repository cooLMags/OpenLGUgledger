<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Trial Balances',
);

$this->menu=array(
	array('label'=>'Create TrialBalance', 'url'=>array('create')),
	array('label'=>'Manage TrialBalance', 'url'=>array('admin')),
);
?>

<h1>Trial Balances</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
