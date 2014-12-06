<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsPostedController */
/* @var $model ParticularsPosted */

$this->breadcrumbs=array(
	'Pending Journal Entries'=>array('JournalEntry/admin'),
	'Posted Journal Entries'=>array('JournalEntryPosted/admin'),
	'Voucher',
);

$this->menu=array(
	//array('label'=>'List ParticularsPosted', 'url'=>array('index')),
	//array('label'=>'Create ParticularsPosted', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#particulars-posted-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Journal Entry Voucher # <?php echo $_GET['jpage']; ?></h1>

</br>

<h3>
	<?php echo "Date: ".$_GET['date'] ?>
</h3>

<h4>
	<?php echo "Explanation: ".$_GET['comment'] ?>
</h4>

<h4>
	<?php echo "Responsibility Center: ".$_GET['center'] ?>
</h4>

</br>


<?php
$journal_p = $_GET['jpage'];
//$journal_id = $_GET['jid'];

$dataProvider = new CActiveDataProvider('Particulars', array(
                    'criteria' => array('condition' => 'journal_page=' . $journal_p,)));
					
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'particulars-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'particular_id',
		//'journal_id',
		//'date',
		'journal_page',
		'ledger_page',
		'account_title',
		'account_code',
		'pr',
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
	),
));
?>

<?php
//print the total
	$td = 0;
	$tc = 0;
	
	$je = JournalEntry::model()->find('journal_page='.$journal_p, array('journal_page'=>$journal_p));
		$td = $je['total_debit'];
		$tc = $je['total_credit'];
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
	&nbsp;&nbsp;<?php echo "P ".number_format($tc,2,".",","); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>