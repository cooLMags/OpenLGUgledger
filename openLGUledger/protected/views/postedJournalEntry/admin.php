<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this PostedJournalEntryController */
/* @var $model PostedJournalEntry */

$this->breadcrumbs=array(
	'Pending Journal Entries'=>array('JournalEntry/admin'),
	'Posted Journal Entries'=>array('JournalEntryPosted/admin'),
	'Complete-Search Posted	 Entries',
);

$this->menu=array(
	//array('label'=>'Posted Journal Entries', 'url'=>array('JournalEntryPosted/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#posted-journal-entry-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Journal Entries (Posted)</h1>
<h3>Complete-Search</h3>

</br></br>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'posted-journal-entry-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'posted_entry',
		'transaction_number',
		'journal_page',
		//'date',
		'year',
		'month',
		'day',
		//'total_debit',
		array(
			'header'=>'Total Debit',
			'value'=>function($data){
				return number_format($data->total_debit, 2);
			},
		),
		//'total_credit',
		array(
			'header'=>'Total Credit',
			'value'=>function($data){
				return number_format($data->total_credit, 2);
			},
		),
		'responsibility_center',
		'comment',
		'entry_type',
		
		array(
			'class'=>'CButtonColumn',
			'template' => '{view}',
		),
	),
)); ?>
