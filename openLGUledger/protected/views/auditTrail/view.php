<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailController */
/* @var $model AuditTrail */

$this->breadcrumbs=array(
	'Audit Trails'=>array('index'),
	$model->audit_trail_id,
);

$this->menu=array(
	array('label'=>'List AuditTrail', 'url'=>array('index')),
	array('label'=>'Create AuditTrail', 'url'=>array('create')),
	array('label'=>'Update AuditTrail', 'url'=>array('update', 'id'=>$model->audit_trail_id)),
	array('label'=>'Delete AuditTrail', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->audit_trail_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AuditTrail', 'url'=>array('admin')),
);
?>

<h1>View AuditTrail #<?php echo $model->audit_trail_id; ?></h1>

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
