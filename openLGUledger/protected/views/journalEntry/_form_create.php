<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryController */
/* @var $model JournalEntry */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'journal-entry-form',
	'enableAjaxValidation'=>false,
)); ?>

	<!--<p class="note">Fields with <span class="required">*</span> are required.</p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'journal_page'); ?>
		<?php echo $form->textField($model,'journal_page', array('value'=>$suggested)); ?>
		<?php echo $form->error($model,'journal_page'); ?>
	</div>

	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'transaction_number'); ?>
		<?php echo $form->textField($model,'transaction_number'); ?>
		<?php echo $form->error($model,'transaction_number'); ?>
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
		<?php
			echo $form->labelEx($model, 'Transaction Date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			    'name'=>'date',
				'attribute'=>'date',
				'model'=>$model,
				
			    'options'=>array(
			        'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
					'dateFormat' => 'yy-mm-dd',
			    ),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'responsibility_center'); ?>
		<?php echo $form->textField($model,'responsibility_center'); ?>
		<?php echo $form->error($model,'responsibility_center'); ?>
	</div>

	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'total_debit'); ?>
		<?php echo $form->textField($model,'total_debit'); ?>
		<?php echo $form->error($model,'total_debit'); ?>
	</div>
	-->

	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'total_credit'); ?>
		<?php echo $form->textField($model,'total_credit'); ?>
		<?php echo $form->error($model,'total_credit'); ?>
	</div>
	-->
	
	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>33)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'entry_type'); ?>
		<?php echo $form->textArea($model,'entry_type',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'entry_type'); ?>
	</div>
	-->
	
	<div class="row">
		<?php echo $form->labelEx($model,'entry_type'); ?>
		<?php
			$array1 = array('Normal' , 'Adjusting');
			echo' <select name="etypes">';
			foreach($array1 as $etypes){
		?>
				<option value="<?php echo $etypes; ?>"><?php echo $etypes; ?></option>
		<?php
			}
			echo'</select>';
		?>
	</div>
	
	
	<!--
	<div class="row">
		<?php echo $form->labelEx($model,'post_status'); ?>
		<?php echo $form->textArea($model,'post_status',array('rows'=>6, 'cols'=>48)); ?>
		<?php echo $form->error($model,'post_status'); ?>
	</div>
	-->
	
	<div class="row buttons" align="right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('name'=>'formcreate')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->