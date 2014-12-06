<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this TrialBalanceController */
/* @var $model TrialBalance */

$this->breadcrumbs=array(
	'Trial Balance',
);

$this->menu=array(
	//array('label'=>'List TrialBalance', 'url'=>array('index')),
	//array('label'=>'Generate a Trial Balance', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#trial-balance-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Trial Balance (Accumulated)</h1>

</br>

<h3>
<?php

	$asof=TrialBalanceDate::model()->find('trial_balance_date_id=1', array('trial_balance_date_id'=>1));
	$date_generated_value=DateGenerated::model()->find('date_generated_id=1', array('date_generated_id'=>1));

	$now = $date_generated_value['date_generated_value'];
	echo "Latest date of entry: ".date("F j, Y", strtotime($now));
?>
</br>
</br>
<?php
	$now = $asof['asof'];
	echo "Date generated: ".date("F j, Y", strtotime($now));
?>
</h3>

</br>
</br>

<?php

			$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialog',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Confirmation',
				        'autoOpen'=>false,
						'resizable'=>false,
				    ),
				));
				echo $this->renderPartial('_form_create', array('model'=>$model)); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Generate a Trial Balance', array(
				   'onclick'=>'$("#mydialog").dialog("open"); return false;',
				));

?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trial-balance-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'trial_balance_id',
		'account_title',
		'account_code',
		//'debit_balance',
		array(
			'header'=>'Debit',
			'value'=>function($data){
				return number_format($data->debit_balance, 2);
			},
		),
		//'credit_balance',
		array(
			'header'=>'Credit',
			'value'=>function($data){
				return number_format($data->credit_balance, 2);
			},
		),
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>

<?php
	$td = 0;
	$tc = 0;
	
	$sql="SELECT * FROM Trial_Balance;";
	$connection=Yii::app()->db;
	$command=$connection->createCommand($sql);
	$kwiri=$command->query();
	
	foreach ($kwiri as $resolt)
	{
		$td = $resolt['debit_balance'] + $td;
		$tc = $resolt['credit_balance'] + $tc;
	}
	
?>

</br>
<div class="row" align="right">
	<b>Total Debit Balance:</b>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;<?php echo "P ".number_format($td,2,".",","); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>
<div class="row" align="right">
	<b>Total Credit Balance:</b>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;<?php echo "P ".number_format($tc,2,".",","); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>


<?php

			$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialogclose',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Confirmation',
				        'autoOpen'=>false,
						'resizable'=>false,
				    ),
				));
				echo $this->renderPartial('_form_close', array('model'=>$model)); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Close Month', array(
				   'onclick'=>'$("#mydialogclose").dialog("open"); return false;',
				));

?>

<?php
//Do not close month option
/*
			$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialogclosenot',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Confirmation',
				        'autoOpen'=>false,
						'resizable'=>false,
				    ),
				));
				echo $this->renderPartial('_form_close_not', array('model'=>$model)); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Do Not Close Month', array(
				   'onclick'=>'$("#mydialogclosenot").dialog("open"); return false;',
				));
*/
?>