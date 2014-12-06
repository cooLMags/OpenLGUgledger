<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsPostedController */
/* @var $model ParticularsPosted */

$this->breadcrumbs=array(
	'Particulars Posteds'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ParticularsPosted', 'url'=>array('index')),
	array('label'=>'Manage ParticularsPosted', 'url'=>array('admin')),
);
?>

<h1>Create ParticularsPosted</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>