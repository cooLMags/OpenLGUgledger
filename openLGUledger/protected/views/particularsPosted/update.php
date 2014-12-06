<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsPostedController */
/* @var $model ParticularsPosted */

$this->breadcrumbs=array(
	'Particulars Posteds'=>array('index'),
	$model->particular_id=>array('view','id'=>$model->particular_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ParticularsPosted', 'url'=>array('index')),
	array('label'=>'Create ParticularsPosted', 'url'=>array('create')),
	array('label'=>'View ParticularsPosted', 'url'=>array('view', 'id'=>$model->particular_id)),
	array('label'=>'Manage ParticularsPosted', 'url'=>array('admin')),
);
?>

<h1>Update ParticularsPosted <?php echo $model->particular_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>