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

	<?php echo $form->errorSummary($model); ?>
	</br>
	<div class="row" align="center">
		<label for="id">Enter End Date (as of):</label>
		<?php
				$this->widget('zii.widgets.jui.CJuiDatePicker',array(
				    'name'=>'enddate',					
				    'options'=>array(
				        'showAnim'=>'fold',//'slide','fold','slideDown','fadeIn','blind','bounce','clip','drop'
						'dateFormat' => 'yy-mm-dd',
				    ),
				    /*'htmlOptions'=>array(
						'style'=>'',
						'value'=>date('Y-m-d'),
					),*/
				));
			?>
	</div>
	
	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton('Close Month', array('name'=>'closeMonth')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->