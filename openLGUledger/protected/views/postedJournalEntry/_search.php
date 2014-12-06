<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $model PostedJournalEntry */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'journal_page'); ?>
		<?php echo $form->textField($model,'journal_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'transaction_number'); ?>
		<?php echo $form->textField($model,'transaction_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'year'); ?>
		<?php echo $form->textField($model,'year'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'month'); ?>
		<?php echo $form->textField($model,'month'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'day'); ?>
		<?php echo $form->textField($model,'day'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'responsibility_center'); ?>
		<?php echo $form->textArea($model,'responsibility_center',array('rows'=>3, 'cols'=>35)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_debit'); ?>
		<?php echo $form->textField($model,'total_debit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'total_credit'); ?>
		<?php echo $form->textField($model,'total_credit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>35)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'entry_type'); ?>
		<?php echo $form->textField($model,'entry_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->