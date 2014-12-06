<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerController */
/* @var $model Ledger */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ledger-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'account_code'); ?>
		<?php echo $form->textField($model,'account_code'); ?>
		<?php echo $form->error($model,'account_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_title'); ?>
		<?php echo $form->textArea($model,'account_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'account_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ledger_page'); ?>
		<?php echo $form->textField($model,'ledger_page'); ?>
		<?php echo $form->error($model,'ledger_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'major_account_title'); ?>
		<?php echo $form->textArea($model,'major_account_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'major_account_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'normal_balance'); ?>
		<?php echo $form->textArea($model,'normal_balance',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'normal_balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'debit'); ?>
		<?php echo $form->textField($model,'debit'); ?>
		<?php echo $form->error($model,'debit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'credit'); ?>
		<?php echo $form->textField($model,'credit'); ?>
		<?php echo $form->error($model,'credit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->