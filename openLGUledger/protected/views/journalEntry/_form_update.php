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

</br>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
			echo $form->labelEx($model,'date');
			$this->widget('zii.widgets.jui.CJuiDatePicker',array(
			    'name'=>'date',
				'attribute'=>'date',
				'model'=>$model,
				
			    'options'=>array(
			        'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
					'dateFormat' => 'yy-mm-dd',
			    ),
			    'htmlOptions'=>array(
			        'style'=>'',
					'value'=>date('Y-m-d'),
			    ),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'responsibility_center'); ?>
		<?php echo $form->textField($model,'responsibility_center'); ?>
		<?php echo $form->error($model,'responsibility_center'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>36)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>
	
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->