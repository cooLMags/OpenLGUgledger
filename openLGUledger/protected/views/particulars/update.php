<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsController */
/* @var $model Particulars */

$this->breadcrumbs=array(
	'Pending Journal Entries'=>array('JournalEntry/admin'),
	'Voucher'.$model->journal_page=>array('JournalEntry/admin'),
	'Update',
);

$this->menu=array(
	//array('label'=>'List Particulars', 'url'=>array('index')),
	//array('label'=>'Create Particulars', 'url'=>array('create')),
	//array('label'=>'View Particulars', 'url'=>array('view', 'id'=>$model->particular_id)),
	//array('label'=>'Manage Particulars', 'url'=>array('admin')),
);
?>

<h1>Update Particular</h1>

<?php echo $this->renderPartial('_form_update', array('model'=>$model)); ?>