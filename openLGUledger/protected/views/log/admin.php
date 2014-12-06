<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Audit Trail'=>array('AuditTrail/admin'),
	'Logs',
);

$this->menu=array(
	//array('label'=>'List Log', 'url'=>array('index')),
	//array('label'=>'Create Log', 'url'=>array('create')),
	array('label'=>'Audit Trail', 'url'=>array('AuditTrail/admin')),
	array('label'=>'Download Reports', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#log-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Log</h1>
</br>
<i>
	*List of pending entries that are attempted to be posted but failed due to infulfilment to some conditions.
</i>
</br>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'log_id',
		'journal_page',
		'comment',
		/*array(
			'class'=>'CButtonColumn',
		),*/
	),
)); ?>
