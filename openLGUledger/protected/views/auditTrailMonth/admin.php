<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailMonthController */
/* @var $model AuditTrail Month*/

$this->breadcrumbs=array(
	'Audit Trail this Month',
);

$this->menu=array(
	//array('label'=>'List AuditTrail', 'url'=>array('index')),
	//array('label'=>'Create AuditTrail', 'url'=>array('create')),
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
		'amount_involved',
		'activity',
		'user',
		array(
			'class'=>'CButtonColumn',
			'class' => 'CButtonColumn',
			'template' => '{delete}',
		),
	),
)); ?>
