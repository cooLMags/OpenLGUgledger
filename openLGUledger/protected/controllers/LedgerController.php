<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

class LedgerController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin','create','view'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('update','delete'),
				'users'=>array('admin'),
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
		$model=new Ledger;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_GET['Ledger'], $_GET['createLedger'])){
			$model->attributes=$_GET['Ledger'];
			
			$model->major_account_title=$_POST['mat'];
			
			if($model->major_account_title=="Expense"){
				$model->normal_balance="Debit";
			}else if($model->major_account_title=="Asset"){
				$model->normal_balance="Debit";
			}else if($model->major_account_title=="Contra-Liability"){
				$model->normal_balance="Debit";
			}else if($model->major_account_title=="Contra-Asset"){
				$model->normal_balance="Credit";
			}else if($model->major_account_title=="Liability"){
				$model->normal_balance="Credit";
			}else if($model->major_account_title=="Capital"){
				$model->normal_balance="Credit";
			}
			
			if($model->save())
				$this->redirect(array('admin','id'=>$model->account_code));
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

		if(isset($_POST['Ledger']))
		{
			$model->attributes=$_POST['Ledger'];
			
			$model->major_account_title=$_POST['mat'];
			
			if($model->major_account_title=="Asset"){
				$model->normal_balance="Debit";
			}else{
				$model->normal_balance="Credit";
			}
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->account_code));
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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Ledger');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Ledger('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['Ledger']))
			$model->attributes=$_GET['Ledger'];

		if(isset($_POST['Ledger'], $_POST['createLedger'])){
			$model->attributes=$_POST['Ledger'];
			
			$model->major_account_title=$_POST['mat'];
			
			if($model->major_account_title=="Asset"){
				$model->normal_balance="Debit";
			}else{
				$model->normal_balance="Credit";
			}
			
			if($model->save())
				$this->redirect(array('admin','id'=>$model->account_code));
		}
		
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Ledger the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Ledger::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Ledger $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='ledger-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
