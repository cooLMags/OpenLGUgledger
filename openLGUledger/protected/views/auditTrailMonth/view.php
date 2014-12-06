<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailMonthController */
/* @var $model AuditTrailMonth */

$this->breadcrumbs=array(
	'Audit Trail Months'=>array('index'),
	$model->audit_trail_id,
);

$this->menu=array(
	array('label'=>'List AuditTrailMonth', 'url'=>array('index')),
	array('label'=>'Create AuditTrailMonth', 'url'=>array('create')),
	array('label'=>'Update AuditTrailMonth', 'url'=>array('update', 'id'=>$model->audit_trail_id)),
	array('label'=>'Delete AuditTrailMonth', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->audit_trail_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuditTrailMonth', 'url'=>array('admin')),
);
?>

<h1>View AuditTrailMonth #<?php echo $model->audit_trail_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'audit_trail_id',
		'date',
		'amount_involved',
		'activity',
		'user',
	),
)); ?>
