<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerController */
/* @var $model Ledger */

$this->breadcrumbs=array(
	'Ledger Accounts',
);

$this->menu=array(
	//array('label'=>'List Ledger', 'url'=>array('index')),
	//array('label'=>'Create Ledger', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ledger-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Ledger Accounts</h1>

</br></br>

<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
		'model'=>$model,
	)); ?>
</div><!-- search-form -->

<?php
				$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialog',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Create a Ledger Account',
				        'autoOpen'=>false,
				    ),
				));
				
					echo $this->renderPartial('_form_create', array('model'=>$model)); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Create a Ledger Account', array(
				   'onclick'=>'$("#mydialog").dialog("open"); return false;',
				));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ledger-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'account_code',
		'account_title',
		'ledger_page',
		'major_account_title',
		//'normal_balance',
		//'debit',
		array(
			'header'=>'Debit',
			'value'=>function($data){
				return number_format($data->debit, 2);
			},
		),
		//'credit',
		array(
			'header'=>'Credit',
			'value'=>function($data){
				return number_format($data->credit, 2);
			},
		),
		
		array(
			'class'=>'CButtonColumn',
		),
	),
));
?>
