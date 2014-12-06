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

</br>
	<div class="row buttons" align="center">
		<?php echo CHtml::submitButton('Ok', array('name'=>'createTrialB')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->