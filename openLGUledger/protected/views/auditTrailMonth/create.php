<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailMonthController */
/* @var $model AuditTrailMonth */

$this->breadcrumbs=array(
	'Audit Trail Months'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AuditTrailMonth', 'url'=>array('index')),
	array('label'=>'Manage AuditTrailMonth', 'url'=>array('admin')),
);
?>

<h1>Create AuditTrailMonth</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>