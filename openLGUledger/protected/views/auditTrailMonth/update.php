<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailMonthController */
/* @var $model AuditTrailMonth */

$this->breadcrumbs=array(
	'Audit Trail Months'=>array('index'),
	$model->audit_trail_id=>array('view','id'=>$model->audit_trail_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AuditTrailMonth', 'url'=>array('index')),
	array('label'=>'Create AuditTrailMonth', 'url'=>array('create')),
	array('label'=>'View AuditTrailMonth', 'url'=>array('view', 'id'=>$model->audit_trail_id)),
	array('label'=>'Manage AuditTrailMonth', 'url'=>array('admin')),
);
?>

<h1>Update AuditTrailMonth <?php echo $model->audit_trail_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>