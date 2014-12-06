<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsPostedController */
/* @var $model ParticularsPosted */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'particular_id'); ?>
		<?php echo $form->textField($model,'particular_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'journal_id'); ?>
		<?php echo $form->textField($model,'journal_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'journal_page'); ?>
		<?php echo $form->textField($model,'journal_page'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ledger_page'); ?>
		<?php echo $form->textField($model,'ledger_page'); ?>
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
		<?php echo $form->label($model,'pr'); ?>
		<?php echo $form->textArea($model,'pr',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'debit'); ?>
		<?php echo $form->textField($model,'debit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'credit'); ?>
		<?php echo $form->textField($model,'credit'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->