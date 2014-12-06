<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this JournalEntryController */
/* @var $model JournalEntry */

$this->breadcrumbs=array(
	'Pending Journal Entries',
);

$this->menu=array(
	array('label'=>'View Posted Entries', 'url'=>array('JournalEntryPosted/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#journal-entry-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Journal Entries (Pending)</h1>

</br></br>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php
							$suggested = 0;
							
							//delete case on log if existing
							$sql="SELECT * FROM Journal_Entry ORDER BY journal_page ASC;";
							$connection=Yii::app()->db;
							$command=$connection->createCommand($sql);
							$query = $command->query();
							
							foreach($query as $result){
								$suggested = $result['journal_page'];
							}
							$suggested = $suggested + 1;
						
				$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialog',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Add an Entry',
				        'autoOpen'=>false,
						'resizable'=>false,
				    ),
				));
				
					echo $this->renderPartial('_form_create', array('model'=>$model, 'suggested'=>$suggested)); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Create an Entry', array(
				   'onclick'=>'$("#mydialog").dialog("open"); return false;',
				));
				
?>

<?php
$dataProvider = new CActiveDataProvider('JournalEntry', array(
                    'criteria' => array('condition' => 'post_status=0',)));
					
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'journal-entry-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'journal_id',
		//'transaction_number',
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
		),
	),
)); ?>
