<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsController */
/* @var $model Particulars */

$this->breadcrumbs=array(
	'Particulars'=>array('admin'),
	'Create',
);

$this->menu=array(
	//array('label'=>'List Particulars', 'url'=>array('index')),
	//array('label'=>'Manage Particulars', 'url'=>array('admin')),
);
?>

<h1>Create a Particular</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>