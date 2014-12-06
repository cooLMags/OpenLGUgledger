<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsPostedController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Particulars Posteds',
);

$this->menu=array(
	array('label'=>'Create ParticularsPosted', 'url'=>array('create')),
	array('label'=>'Manage ParticularsPosted', 'url'=>array('admin')),
);
?>

<h1>Particulars Posteds</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
