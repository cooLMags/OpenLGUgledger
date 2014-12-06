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
		
		<input type="hidden" name="yungPage"
			value="<?php echo $_GET['jpage'];?>" />
		
		</br>
		
		<div class="row buttons" align="center">
			<?php echo CHtml::submitButton('Confirm', array('name'=>'postEntry')); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->