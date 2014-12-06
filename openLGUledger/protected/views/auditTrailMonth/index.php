<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this AuditTrailMonthController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Audit Trail Months',
);

$this->menu=array(
	array('label'=>'Create AuditTrailMonth', 'url'=>array('create')),
	array('label'=>'Manage AuditTrailMonth', 'url'=>array('admin')),
);
?>

<h1>Audit Trail Months</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
