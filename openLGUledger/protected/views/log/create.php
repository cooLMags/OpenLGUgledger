<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Audit Trail'=>array('AuditTrail/admin'),
	'Download Reports',
);

$this->menu=array(
	//array('label'=>'List Log', 'url'=>array('index')),
	//array('label'=>'Manage Log', 'url'=>array('admin')),
	array('label'=>'Audit Trail', 'url'=>array('AuditTrail/admin')),
	array('label'=>'Log', 'url'=>array('Log/admin')),
);
?>

<h1>Download Reports</h1>

<?php echo $this->renderPartial('_form_download', array('model'=>$model)); ?>