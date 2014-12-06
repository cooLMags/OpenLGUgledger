<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $model TrialBalance */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'trial_balance_id'); ?>
		<?php echo $form->textField($model,'trial_balance_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_title'); ?>
		<?php echo $form->textArea($model,'account_title',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'account_code'); ?>
		<?php echo $form->textField($model,'account_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'debit_balance'); ?>
		<?php echo $form->textField($model,'debit_balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credit_balance'); ?>
		<?php echo $form->textField($model,'credit_balance'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->