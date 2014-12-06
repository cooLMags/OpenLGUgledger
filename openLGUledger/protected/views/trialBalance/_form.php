<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $model TrialBalance */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trial-balance-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'account_title'); ?>
		<?php echo $form->textArea($model,'account_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'account_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_code'); ?>
		<?php echo $form->textField($model,'account_code'); ?>
		<?php echo $form->error($model,'account_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debit_balance'); ?>
		<?php echo $form->textField($model,'debit_balance'); ?>
		<?php echo $form->error($model,'debit_balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'credit_balance'); ?>
		<?php echo $form->textField($model,'credit_balance'); ?>
		<?php echo $form->error($model,'credit_balance'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->