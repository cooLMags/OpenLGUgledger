<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php
/* @var $this ParticularsController */
/* @var $model Particulars */

$this->breadcrumbs=array(
	'Pending Journal Entries'=>array('JournalEntry/admin'),
	'Voucher'
);

$this->menu=array(
	//array('label'=>'List Particulars', 'url'=>array('index')),
	//array('label'=>'Post This Entry',
	//'url'=>array('ParticularsDummy/create'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#particulars-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Journal Entry Voucher # <?php echo $_GET['jpage']; ?></h1>

</br>

<h3>
	<?php echo "Date: ".$_GET['date'] ?>
</h3>

<h4>
	<?php echo "Explanation: ".$_GET['comment'] ?>
</h4>

<h4>
	<?php echo "Responsibility Center: ".$_GET['center'] ?>
</h4>

</br>
</br>


<?php
$journal_p = $_GET['jpage'];

$dataProvider = new CActiveDataProvider('Particulars', array(
                    'criteria' => array('condition' => 'journal_page=' . $journal_p,)));

				$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
				    'id'=>'mydialog',
				    // additional javascript options for the dialog plugin
				    'options'=>array(
				        'title'=>'Add a Particular',
				        'autoOpen'=>false,
						'resizable'=>false,
				    ),
				));
				echo $this->renderPartial('_form', array('model'=>$model, 'jpage'=>$_GET['jpage'])); 
				$this->endWidget('zii.widgets.jui.CJuiDialog');

				// the link that may open the dialog
				echo CHtml::submitButton('Add a Particular', array(
				   'onclick'=>'$("#mydialog").dialog("open"); return false;',
				));
					
					
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'particulars-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		//'particular_id',
		//'journal_id',
		'date',
		'journal_page',
		'ledger_page',
		'account_title',
		'account_code',
		'pr',
		//'debit',
		array(
			'header'=>'Debit',
			'value'=>function($data){
				return number_format($data->debit, 2);
			},
		),
		//'credit',
		array(
			'header'=>'Credit',
			'value'=>function($data){
				return number_format($data->credit, 2);
			},
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{update}{delete}',
		),
	),
));
?>

<?php
//print the total
	$td = 0;
	$tc = 0;
	
	$je = JournalEntry::model()->find('journal_page='.$journal_p, array('journal_page'=>$journal_p));
		$td = $je['total_debit'];
		$tc = $je['total_credit'];
?>
</br>

<div class="row" align="right">
	<b>Total Debit:</b>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;<?php echo "P ".number_format($td,2,".",","); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>
<div class="row" align="right">
	<b>Total Credit:</b>&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;<?php echo "P ".number_format($tc,2,".",","); ?>
</div>
<div class="row" align="right">
	<?php echo "==="; ?>
</div>

</br>
		<div class="row" align="right">
			<div class="column">
			&nbsp;
			<?php
				
				$srow=StatusHolder::model()->find('constant_id=1', array('constant_id'=>1));
				$lastm = $srow['last_month_status'];
				$todaym = $srow['today_month_status'];
				$accepts = $srow['accept_status'];
				$dateh = $srow['date_holder'];
				
				//check if change in month
				//if yes, update month holder, copy today_month_status to last_month_status, set today_month_status to open, update accept_status
					if(date('m', strtotime($dateh))!=date('m')){
						$srow->delete();
						
						$user = Yii::app()->db->createCommand()
									->insert('status_holder', array(
									    'date_holder'=>date('Y-m-d'),
									    'constant_id'=>1,
								));
						
						$user = Yii::app()->db->createCommand()
								->update('status_holder', array('last_month_status'=>new CDbExpression($todaym)), 'constant_id=1', array('constant_id' => 1));
						
						$user = Yii::app()->db->createCommand()
								->update('status_holder', array('today_month_status'=>new CDbExpression(0)), 'constant_id=1', array('constant_id' => 1));
						
						//update accept_status based on today_month_status that will be copied to last_month_status later
						if($todaym==0){//if open
							$user = Yii::app()->db->createCommand()
									->update('status_holder', array('accept_status'=>new CDbExpression(1)), 'constant_id=1', array('constant_id' => 1));
						}else{
							$user = Yii::app()->db->createCommand()
									->update('status_holder', array('accept_status'=>new CDbExpression(0)), 'constant_id=1', array('constant_id' => 1));
						}
					}
				
				$srow=StatusHolder::model()->find('constant_id=1', array('constant_id'=>1));
				
				if($_GET['status'] == 0 && $srow['last_month_status']==1 && date('m', strtotime($_GET['date']))<=date('m')){	//status is pending AND month of entry is same with today's month | Add '&& srow[accept_status]==0' to the condition if using the do not close month option
						$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
						    'id'=>'mydialog2',
						    // additional javascript options for the dialog plugin
						    'options'=>array(
						        'title'=>'Confirm Posting of Entry',
						        'autoOpen'=>false,
						    ),
						));
							echo $this->renderPartial('_form_post', array('jpage'=>$journal_p)); 
							
						$this->endWidget('zii.widgets.jui.CJuiDialog');
							
						// the link that may open the dialog
						echo CHtml::submitButton('Post Entry', array(
						   'onclick'=>'$("#mydialog2").dialog("open"); return false;',
						   'id'=>'my_id',
						));
						
				}//if
			?>
		</div>
		
	<?php echo CHtml::htmlButton ('Refresh', array('onClick'=>'window.location="'.Yii::app()->getRequest()->getUrl().'"')); ?>
</div>