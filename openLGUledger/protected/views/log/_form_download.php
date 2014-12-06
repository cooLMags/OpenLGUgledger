<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LogController */
/* @var $model Log */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	
	
	<p class="note">Click a button below to download the Accumulated Trial Balance.</p>
	<div class="row buttons">
		<div class="column butons">
		<?php echo CHtml::submitButton('Download Excel', array('name'=>'TrialBalanceExcel')); ?>
		</div>
		<!--<div class="column butons">
		<?php echo CHtml::submitButton('PDF', array('name'=>'TrialBalancePDF')); ?>
		</div>-->
	</div>
	
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	
	<p class="note">Fill up the dates and click the button below to download Journal Entries.</p>
	
	<div class="row">
		<div class="column">
			<?php echo $form->labelEx($model, 'Date From '); ?>
		</div>
		<div class="column">
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'jfromdate',					
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
	</div>
		
	<div class="row">
		<div class="column">
			<?php echo $form->labelEx($model, 'To: '); ?>
		</div>
		<div class="column">
			<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'jtodate',				
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
	</div>
	
	<div class="row">
		<div class="column butons">
			<?php echo CHtml::submitButton('Download Excel', array('name'=>'JournalEntryExcel')); ?>
		</div>
		<!--<div class="column butons">
			<?php echo CHtml::submitButton('PDF', array('name'=>'JournalEntryPDF')); ?>
		</div>-->
	</div>
	
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	</br>
	
	<p class="note">Click the button below to download an excel file of the Ledger. (See Chart of Accounts)</p>
	<div class="row">
		<label for="id">Enter Ledger Account Number</label>
		<?php echo CHtml::textField('lan', ''); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Download',array('name' => 'LedgerExcel')); ?>
	</div>
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->