<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

class JournalEntryController extends Controller
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
		$model=new JournalEntry;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['JournalEntry']))
		{
			$model->attributes=$_POST['JournalEntry'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->journal_id));
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

		if(isset($_POST['JournalEntry'], $_POST['etypes']))
		{
			$model->attributes=$_POST['JournalEntry'];
			$model->entry_type=$_POST['etypes'];
			/*
			//update the dates of the particulars			
				$sql="SELECT * FROM Particulars WHERE journal_page=".$model->journal_page.";";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$query=$command->query();
				
				foreach($query as $parti){
					$user = Yii::app()->db->createCommand()
							->update('particulars', array('date'=>strtotime($model->date)), 'particular_id='.$parti['particular_id'], array('particular_id' => $parti['particular_id']));
				}
			*/
			if($model->save()){
				
				//record to audit trail
					$user = Yii::app()->db->createCommand()
						->insert('audit_trail', array(
							'date'=>new CDbExpression('NOW()'),
							'amount_involved'=>$model->total_debit,
							'activity'=>"Updated journal #".$model->journal_page,
							'user'=>Yii::app()->user->id,
						));
								
				$this->redirect(array('admin','id'=>$model->journal_id));
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
		$journal_page = $this->loadModel($id)->journal_page;
		$amount = $this->loadModel($id)->total_debit;
		$connection=Yii::app()->db;
		$transaction = $connection->beginTransaction();
				
		try{
			//delete the main journal
			if($this->loadModel($id)->delete()){
				//find the particulars affected
				$sql="DELETE FROM Particulars WHERE journal_page=".$journal_page.";";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$command->query();
				
				//delete record in log if existing
				$sql="DELETE FROM log WHERE journal_page=".$journal_page.";";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$command->query();
			}
			
			//record to audit trail
				$user = Yii::app()->db->createCommand()
					->insert('audit_trail', array(
						'date'=>new CDbExpression('NOW()'),
						'amount_involved'=>$amount,
						'activity'=>"Deleted journal #".$journal_page,
						'user'=>Yii::app()->user->id,
					));
			
			//commit
			$transaction->commit();
					
		}catch(Exception $e){
			$transaction->rollBack();
		}
		
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('JournalEntry');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new JournalEntry('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['JournalEntry']))
			$model->attributes=$_GET['JournalEntry'];
			
		if(isset($_POST['JournalEntry'], $_POST['formcreate'], $_POST['etypes'])){
			$model->attributes=$_POST['JournalEntry'];
			$model->entry_type = $_POST['etypes'];
			$model->post_status = 0;
			
			if($model->save()){
				//record to audit trail
					$user = Yii::app()->db->createCommand()
						->insert('audit_trail', array(
							'date'=>new CDbExpression('NOW()'),
							'amount_involved'=>0,
							'activity'=>" Created journal #".$model->journal_page,
							'user'=>Yii::app()->user->id,
						));
						
				$this->redirect(array('particulars/admin','jid'=>$model->journal_id, 'jpage'=>$model->journal_page, 'status'=>$model->post_status, 'date'=>$model->date, 'comment'=>$model->comment, 'center'=>$model->responsibility_center));
			}
		
		}
		
		if(isset($_POST['hello'])){
			$this->redirect(array('Log/admin'));
		}

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return JournalEntry the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=JournalEntry::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param JournalEntry $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='journal-entry-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
