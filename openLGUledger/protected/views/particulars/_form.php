<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsController */
/* @var $model Particulars */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'particulars-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'journal_id'); ?>
		<?php echo $form->textField($model,'journal_id'); ?>
		<?php echo $form->error($model,'journal_id'); ?>
	</div>
	-->
	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>
	-->
	
	<div class="row">
		<?php echo $form->labelEx($model,'journal_page'); ?>
		<?php echo $form->textField($model,'journal_page', array('value'=>$_GET['jpage'])); ?>
		<?php echo $form->error($model,'journal_page'); ?>
	</div>
	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'ledger_page'); ?>
		<?php echo $form->textField($model,'ledger_page'); ?>
		<?php echo $form->error($model,'ledger_page'); ?>
	</div>
	-->
	
	<div class="row">
		<?php echo $form->hiddenField($model,'ledger_page', array('value'=>0)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'account_title'); ?>
		<?php echo $form->textField($model,'account_title'); ?>
		<?php echo $form->error($model,'account_title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'account_code'); ?>
		<?php echo $form->textField($model,'account_code'); ?>
		<?php echo $form->error($model,'account_code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pr'); ?>
		<?php echo $form->textField($model,'pr'); ?>
		<?php echo $form->error($model,'pr'); ?>
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
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'createParti')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->