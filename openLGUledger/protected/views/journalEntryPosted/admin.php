<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryPostedController */
/* @var $model JournalEntryPosted */

$this->breadcrumbs=array(
	'Pending Journal Entries'=>array('JournalEntry/admin'),
	'Posted Journal Entries',
);

$this->menu=array(
	array('label'=>'Complete-Search Posted Entries', 'url'=>array('PostedJournalEntry/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#journal-entry-posted-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Journal Entries (Posted)</h1>

</br></br>

<?php
$dataProvider = new CActiveDataProvider('JournalEntry', array(
                    'criteria' => array('condition' => 'post_status=1')));
					
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'journal-entry-posted-grid',
		'dataProvider'=>$dataProvider,
		//'filter'=>$model,
		'columns'=>array(
			'transaction_number',
			//'journal_id',
			'date',
			'journal_page',
			//'total_debit',
			array(
				'header'=>'Debit',
				'value'=>function($data){
					return number_format($data->total_debit, 2);
				},
			),
			//'total_credit',
			array(
				'header'=>'Credit',
				'value'=>function($data){
					return number_format($data->total_credit, 2);
				},
			),
			'responsibility_center',
			'comment',
			'entry_type',
			//'post_status',
			
			array(
				'class' => 'CButtonColumn',
				'template' => '{view}',
				//'viewButtonUrl' =>'Yii::app()->createUrl("/",array("journalEntryPosted" => $data->primaryKey))',
			),
		),
	));
?>
