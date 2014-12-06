<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this UsersController */
/* @var $model Users */

$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	//array('label'=>'List Users', 'url'=>array('index')),
	//array('label'=>'Create Users', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#users-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Users</h1>

</br>
</br>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php
			$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialog',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Create a User',
				        'autoOpen'=>false,
				    ),
				));
				echo $this->renderPartial('_form_create', array('model'=>$model)); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Create a User', array(
				   'onclick'=>'$("#mydialog").dialog("open"); return false;',
			));
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'user_id',
		'first_name',
		'last_name',
		'email',
		'username',
		//'password',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
