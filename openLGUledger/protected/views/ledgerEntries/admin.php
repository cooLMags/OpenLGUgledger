<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LedgerEntriesController */
/* @var $model LedgerEntries */

$this->breadcrumbs=array(
	'Ledger Accounts'=>array('Ledger/admin'),
	'Ledger Entries',
);

$this->menu=array(
	//array('label'=>'List LedgerEntries', 'url'=>array('index')),
	//array('label'=>'Create LedgerEntries', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#ledger-entries-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><?php echo $_GET['ltitle']; ?></h1>

<h3>
	<?php echo "Account Code: ".$_GET['lcode'] ?>
</h3>

<h4>
	<?php echo "Ledger Page: ".$_GET['lpage'] ?>
</h4>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
	$dataProvider = new CActiveDataProvider('LedgerEntries', array(
                    'criteria' => array('condition' => 'account_code=' . $_GET['lcode'],)));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ledger-entries-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'ledger_entry_id',
		//'particular_id',
		'date',
		//'account_title',
		//'account_code',		
		'journal_page',
		//'ledger_page',
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
		
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>

<?php
//print the total
	$td = 0;
	$tc = 0;
	
	$l = Ledger::model()->find('account_code='.$_GET['lcode'], array('account_code'=>$_GET['lcode']));
		$td = $l['debit'];
		$tc = $l['credit'];
?>
</br>

<div class="row" align="right">
	<b>Total Debit:</b>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;<?php echo "P ".number_format($td,2,".",","); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>
<div class="row" align="right">
	<b>Total Credit:</b>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;<?php echo "P ".number_format($tc,2,".",""); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>

<div class="row" align="right">
	<?php echo CHtml::htmlButton ('Refresh', array('onClick'=>'window.location="'.Yii::app()->getRequest()->getUrl().'"')); ?>
</div>