<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailController */
/* @var $model AuditTrail */

$this->breadcrumbs=array(
	'Audit Trail',
);

$this->menu=array(
	//array('label'=>'List AuditTrail', 'url'=>array('index')),
	//array('label'=>'Create AuditTrail', 'url'=>array('create')),
	//array('label'=>'View Audit Trail for this month', 'url'=>array('AuditTrailMonth/admin')),
	array('label'=>'Download Reports', 'url'=>array('Log/create')),
	array('label'=>'Log', 'url'=>array('Log/admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#audit-trail-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Audit Trail</h1>

</br>
</br>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'audit-trail-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'audit_trail_id',
		'date',
		array(
			'header'=>'Amount Involved',
			'value'=>function($data){
				return number_format($data->amount_involved, 2);
			},
		),
		'activity',
		'user',
		array(
			'class'=>'CButtonColumn',
			'class' => 'CButtonColumn',
			'template' => '{delete}',
		),
	),
)); ?>
