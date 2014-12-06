<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

class ParticularsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform these actions
				'actions'=>array('create','update','admin','delete','view'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Particulars;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		//create a particular
		if(isset($_POST['createParti'], $_POST['Particulars']))
		{
			$model->attributes=$_POST['Particulars'];
			
			if($model->save())
				$this->redirect(array('admin','id'=>$model->particular_id));
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Particulars']))
		{
			$model->attributes=$_POST['Particulars'];
			
			if($model->save())
			{
				//update the journal entry's total debit and credit
						$totald = 0;
						$totalc = 0;
				
					//find the particulars
					$sql="SELECT * FROM particulars WHERE journal_page=".$model->journal_page.";";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$parti=$command->query();
					
					foreach($parti as $culars){
						$totald = $culars['debit'] + $totald;
						$totalc = $culars['credit'] + $totalc;
					}
				
					//finally, update them now
					$user = Yii::app()->db->createCommand()
							->update('journal_entry', array('total_debit'=>new CDbExpression($totald)), 'journal_page='.$model->journal_page, array('journal_page' => $model->journal_page));
					
					$user = Yii::app()->db->createCommand()
							->update('journal_entry', array('total_credit'=>new CDbExpression($totalc)), 'journal_page='.$model->journal_page, array('journal_page' => $model->journal_page));
					
				//redirection
				$jerow=JournalEntry::model()->find('journal_page='.$model->journal_page, array('journal_page'=>$model->journal_page));
				$this->redirect(array('admin','jid'=>$model->journal_id, 'jpage'=>$jerow['journal_page'], 'status'=>$jerow['post_status'], 'date'=>$jerow['date'], 'comment'=>$jerow['comment'], 'center'=>$jerow['responsibility_center']));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		
		//find the journal entry where it belongs
		$jerow=JournalEntry::model()->find('journal_page='.$model->journal_page, array('journal_page'=>$model->journal_page));				
		
		//finally, update them now
			$user = Yii::app()->db->createCommand()
					->update('journal_entry', array('total_debit'=>new CDbExpression($jerow['total_debit']-$model->debit)), 'journal_page='.$model->journal_page, array('journal_page' => $model->journal_page));
					
			$user = Yii::app()->db->createCommand()
					->update('journal_entry', array('total_credit'=>new CDbExpression($jerow['total_credit']-$model->credit)), 'journal_page='.$model->journal_page, array('journal_page' => $model->journal_page));
			
		$model->delete();
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Particulars');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Particulars('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Particulars']))
			$model->attributes=$_GET['Particulars'];
		
		//CREATE a particular
		if(isset($_POST['createParti'], $_POST['Particulars']))
		{
			$model->attributes=$_POST['Particulars'];
			
			//search if a journal page is existing
				$sql="SELECT * FROM Journal_Entry WHERE journal_page=".$model->journal_page.";";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$query=$command->queryScalar();
				
			//search if a ledger account is existing
				$sql="SELECT * FROM Ledger WHERE account_code=".$model->account_code.";";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$query2=$command->queryScalar();
				
			if($query!=0 && $query2!=0){	//there exist
				$connection=Yii::app()->db;
				$transaction = $connection->beginTransaction();
				
				try{
					//get the row of the current journal entry
					$jerow=JournalEntry::model()->find('journal_page='.$model->journal_page, array('journal_page'=>$model->journal_page));				
						
					//copy journal_id using $model->journal_page	
						$model->journal_id = $jerow['journal_id'];
					
					//copy date
						$model->date = $jerow['date'];
						
					//recheck account title and add ledger page through account code
						//get the row of the current journal entry
						$lrow=Ledger::model()->find('account_code='.$model->account_code, array('account_code'=>$model->account_code));
						$model->account_title = $lrow['account_title'];
						$model->ledger_page = $lrow['ledger_page'];
						
					if($model->save())
					{
						//update the journal entry's total debit and credit
							$totald = 0;
							$totalc = 0;
					
							//find the particulars
							$sql="SELECT * FROM particulars WHERE journal_page=".$model->journal_page.";";
							$connection=Yii::app()->db;
							$command=$connection->createCommand($sql);
							$parti=$command->query();
							
							foreach($parti as $culars){
								$totald = $culars['debit'] + $totald;
								$totalc = $culars['credit'] + $totalc;
							}
								
						//finally, update them now
						$user = Yii::app()->db->createCommand()
								->update('journal_entry', array('total_debit'=>new CDbExpression($totald)), 'journal_page='.$model->journal_page, array('journal_page' => $model->journal_page));
								
						$user = Yii::app()->db->createCommand()
								->update('journal_entry', array('total_credit'=>new CDbExpression($totalc)), 'journal_page='.$model->journal_page, array('journal_page' => $model->journal_page));
								
						//commit
						$transaction->commit();
						
						//redirection
						$this->redirect(array('particulars/admin', 'jpage'=>$model->journal_page, 'status'=>$jerow['post_status'], 'date'=>$model->date, 'comment'=>$jerow['comment'], 'center'=>$jerow['responsibility_center']));
					}
				}catch(Exception $e){
					$transaction->rollBack();
				}
			}//if query
		}//createParti
		
		//POSTING OF JOURNAL ENTRY
		if(isset($_POST['postEntry'], $_POST['yungPage'])){
			
			//find the journal entry
			$jerow=JournalEntry::model()->find('journal_page='.$_POST['yungPage'], array('journal_page'=>$_POST['yungPage']));				
			
			if($jerow['total_debit']==$jerow['total_credit'] && ($jerow['total_debit'] && $jerow['total_credit'])!=0){
				
				$connection=Yii::app()->db;
				$transaction = $connection->beginTransaction();
				
				try{
					//Update journal entry's status to "Posted"
						$user = Yii::app()->db->createCommand()
								->update('journal_entry', array('post_status'=>new CDbExpression(1)), 'journal_page='.$jerow['journal_page'], array('journal_page' => $jerow['journal_page']));
					
					//Add transaction number to it
						//increment the value first
						$trow=TransactionNumber::model()->find('transaction_number_id=1', array('transaction_number_id'=>1));
						
						$user = Yii::app()->db->createCommand()
								->update('transaction_number', array('transaction_number_value'=>new CDbExpression($trow['transaction_number_value']+1)), 'transaction_number_id=1', array('transaction_number_id' => 1));
						
						//find back for the incremented value
						$trow=TransactionNumber::model()->find('transaction_number_id=1', array('transaction_number_id'=>1));
					
						//add the transaction number to the journal entry
						$user = Yii::app()->db->createCommand()
								->update('journal_entry', array('transaction_number'=>new CDbExpression($trow['transaction_number_value'])), 'journal_page='.$jerow['journal_page'], array('journal_page' => $jerow['journal_page']));
					
					//copy the journal entry to posted journal entry table
						$user = Yii::app()->db->createCommand()
									->insert('posted_journal_entry', array(
										'journal_page'=>$jerow['journal_page'],
										'transaction_number'=>$trow['transaction_number_value'],
										'date'=>$jerow['date'],
										'year'=>date('Y', strtotime($jerow['date'])),
										'month'=>date('F', strtotime($jerow['date'])),
										'day'=>date('j', strtotime($jerow['date'])),
										'responsibility_center'=>$jerow['responsibility_center'],
										'total_debit'=>$jerow['total_debit'],
										'total_credit'=>$jerow['total_credit'],
										'comment'=>$jerow['comment'],
										'entry_type'=>$jerow['entry_type'],
									));
					
					
					//Insert new entry to Ledger by making a ledger entry
						//find all particulars having the specified journal page
							$sql="SELECT * FROM particulars WHERE journal_page=".$jerow['journal_page'].";";
							$connection=Yii::app()->db;
							$command=$connection->createCommand($sql);
							$parti=$command->query();
							
						//for each particular, copy the values to the new ledger entry
							foreach($parti as $culars){
								//the ledger page will be provided by consulting the Ledger
								$lrow=Ledger::model()->find('account_code='.$culars['account_code'], array('account_code'=>$culars['account_code']));
								
								//finally, insert new ledger entry
								$user = Yii::app()->db->createCommand()
									->insert('ledger_entries', array(
									    'particular_id'=>$culars['particular_id'],
									    'date'=>$culars['date'],
									    'account_title'=>$culars['account_title'],
									    'account_code'=>$culars['account_code'],
									    'journal_page'=>$culars['journal_page'],
									    'ledger_page'=>$lrow['ledger_page'],//
									    'debit'=>$culars['debit'],
									    'credit'=>$culars['credit'],
								));
								
								//update date_generated
								$dgrow=DateGenerated::model()->find('date_generated_id=1', array('date_generated_id'=>1));
								$dgrow->delete();
								
								$user = Yii::app()->db->createCommand()
									->insert('date_generated', array(
									    'date_generated_id'=>1,
									    'date_generated_value'=>$culars['date'],
								));
									
								//update the ledger's debit and credit using the account code
								$user = Yii::app()->db->createCommand()
										->update('ledger', array('debit'=>new CDbExpression($lrow['debit']+$culars['debit'])), 'account_code='.$culars['account_code'], array('account_code' => $culars['account_code']));
										
								$user = Yii::app()->db->createCommand()
										->update('ledger', array('credit'=>new CDbExpression($lrow['credit']+$culars['credit'])), 'account_code='.$culars['account_code'], array('account_code' => $culars['account_code']));
										
							}//foreach $parti				
							
						//record to audit trail
						$user = Yii::app()->db->createCommand()
							->insert('audit_trail', array(
								'date'=>new CDbExpression('NOW()'),
								'amount_involved'=>$jerow['total_debit'],
								'activity'=>"POSTED transaction #".$trow['transaction_number_value'],
								'user'=>Yii::app()->user->id,
							));
							
						//delete from log if journal posted is existing	
						$sql="DELETE FROM log WHERE journal_page=".$jerow['journal_page'].";";
							$connection=Yii::app()->db;
							$command=$connection->createCommand($sql);
							$parti=$command->query();
								
							
					//commit
					$transaction->commit();
					
					//Redirection
					$this->redirect(array('JournalEntryPosted/admin'));
					
				}catch(Exception $e){
					$transaction->rollBack();
				}	
			}//if balanced
			else if($jerow['total_debit']!=$jerow['total_credit'])
			{
				//record to log
				$user = Yii::app()->db->createCommand()
						->insert('log', array(
							'journal_page'=>$jerow['journal_page'],
							'comment'=>"The Debit and Credit of the Journal Entry is UNBALANCED",
						));
				
			}//if unbalanced
			else if(($jerow['total_debit'] && $jerow['total_credit'])==0)
			{
				//record to log
				$user = Yii::app()->db->createCommand()
						->insert('log', array(
							'journal_page'=>$jerow['journal_page'],
							'comment'=>"The Debit and Credit of the Journal Entry are both ZEROES",
						));
			}
		}//Posting
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Particulars the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Particulars::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Particulars $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='particulars-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
