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
	
	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton('Do Not Close Month', array('name'=>'closenotMonth')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->