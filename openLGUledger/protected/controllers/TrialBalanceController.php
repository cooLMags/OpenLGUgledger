<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

class TrialBalanceController extends Controller
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
				'actions'=>array('create','admin','view'),
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
		$model=new TrialBalance;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TrialBalance']))
		{
			$model->attributes=$_POST['TrialBalance'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->trial_balance_id));
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

		if(isset($_POST['TrialBalance']))
		{
			$model->attributes=$_POST['TrialBalance'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->trial_balance_id));
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
		$dataProvider=new CActiveDataProvider('TrialBalance');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new TrialBalance('search');
		$model->unsetAttributes();  // clear any default values
		
		if(isset($_GET['TrialBalance']))
			$model->attributes=$_GET['TrialBalance'];

			
		if(isset($_POST['createTrialB']))
		{

			$connection=Yii::app()->db;
			$transaction = $connection->beginTransaction();
				
			try{
				//clear first the existing trial balace to completely overwrite it
				$sql="DELETE FROM Trial_Balance;";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$command->query();
					
				//select all the ledgers
				$sql="SELECT * FROM ledger ORDER BY account_code ASC;";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$ledgers = $command->query();
				
				foreach($ledgers as $result){
					$nbal = Ledger::model()->find('account_code='.$result['account_code'], array('account_code'=>$result['account_code']));
							
						if($nbal['normal_balance'] == "Debit"){
							$debit = $result['debit'] - $result['credit'];
							$credit = 0;
						}else{
							$debit = 0;
							$credit = $result['credit'] - $result['debit'];
						}
						
					//insert a row to the Trial Balance
						$user = Yii::app()->db->createCommand()
									->insert('trial_balance', array(
									    'account_title'=>$result['account_title'],
									    'account_code'=>$result['account_code'],
										'debit_balance'=>$debit,
									    'credit_balance'=>$credit,
								));
				}//foreach
				
				//record to audit trail
					$user = Yii::app()->db->createCommand()
						->insert('audit_trail', array(
							'date'=>new CDbExpression('NOW()'),
							'amount_involved'=>$debit,
							'activity'=>"Generated a Trial Balance",
							'user'=>Yii::app()->user->id,
						));
						
				//update trial balance date
					$sql="DELETE FROM Trial_Balance_Date;";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$command->query();
					
					$user = Yii::app()->db->createCommand()
								->insert('trial_balance_date', array(
									'trial_balance_date_id'=>1,
								    'asof'=>date('Y-m-d'),
								));
								
				//commit
					$transaction->commit();
						
				//Redirection
					$this->redirect(array('TrialBalance/admin'));
				
			}catch(Exception $e){
				$transaction->rollBack();
			}	
			
		}//if button createTrialB
		
//close the month
		if(isset($_POST['closeMonth'], $_POST['enddate'])){
			
			if($_POST['enddate']!=''){
				$enddate = $_POST['enddate'];
				$allow = 0;
				
				//if date today is somewhere at the end of the month, set last_month_status and today_month_status to closed and accept_status to open
				if(date('d')>27 && date('d')<32){ //early closing of month if necessary is allowed in the last days of the month
					$srow=StatusHolder::model()->find('constant_id=1', array('constant_id'=>1));
					$srow->delete();
					$user = Yii::app()->db->createCommand()
								->insert('status_holder', array(
								    'date_holder'=>date('Y-m-d'),
								    'last_month_status'=>1,
								    'today_month_status'=>1,
								    'accept_status'=>0,
								    'constant_id'=>1,
							));
							
					$allow = 1;
				}else{	//late closing of month which is usually done
					
					//update status_holder
					//update date_holder to date today, last_month_status to closed,  today_month_status to open, accept_status to open, and constant_id to 1
					$srow=StatusHolder::model()->find('constant_id=1', array('constant_id'=>1));
					$srow->delete();
					$user = Yii::app()->db->createCommand()
								->insert('status_holder', array(
								    'date_holder'=>date('Y-m-d'),
								    'last_month_status'=>1,
								    'today_month_status'=>0,
								    'accept_status'=>0,
								    'constant_id'=>1,
							));
					$allow = 1;
				}		
		//////////////////
				if($allow==1){
					//create a trial balance
					$sql="DELETE FROM Trial_Monthly;";
						$connection=Yii::app()->db;
						$command=$connection->createCommand($sql);
						$command->query();
						
					//select all the ledgers
					$sql="SELECT * FROM ledger ORDER BY account_code ASC;";
						$connection=Yii::app()->db;
						$command=$connection->createCommand($sql);
						$ledgers = $command->query();
					
					foreach($ledgers as $result){
						$nbal = Ledger::model()->find('account_code='.$result['account_code'], array('account_code'=>$result['account_code']));
								
							if($nbal['normal_balance'] == "Debit"){
								$debit = $result['debit'] - $result['credit'];
								$credit = 0;
							}else{
								$debit = 0;
								$credit = $result['credit'] - $result['debit'];
							}
							
						//insert a row to the Trial Balance
							$user = Yii::app()->db->createCommand()
										->insert('trial_monthly', array(
										    'account_title'=>$result['account_title'],
										    'account_code'=>$result['account_code'],
											'debit_balance'=>$debit,
										    'credit_balance'=>$credit,
									));
					}//foreach
					
					
				//create excel file and download it
					$sql="SELECT * FROM Trial_Monthly;";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$trialMmodelcount=$command->queryScalar();
				
					if($trialMmodelcount!=0)
					{
						Yii::import('ext.phpexcel.XPHPExcel');    
						$objPHPExcel= XPHPExcel::createPHPExcel();
						$objPHPExcel->getProperties()->setCreator("OpenLGU")
									->setLastModifiedBy("OpenLGU")
									->setTitle("Office 2007 XLSX Test Document")
									->setSubject("Office 2007 XLSX Test Document")
									->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									->setKeywords("office 2007 openxml php")
									->setCategory("Test result file");
						
						$worksheet = $objPHPExcel->setActiveSheetIndex();
						
						$row = 9;
						$rowinit = 9;
						$total_d = 0;
						$total_c = 0;
						$enddate = strtoupper(date('F Y', strtotime($enddate)));
							
							$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-7).':F'.($row-7));
							$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-6).':F'.($row-6));
							$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-5).':F'.($row-5));
							
							$worksheet->setCellValue('B'.($row-7), 'MUNICIPALITY OF LOS BANOS');
							$worksheet->setCellValue('B'.($row-6), 'PRELIMINARY TRIAL BALANCE');
							$worksheet->setCellValue('B'.($row-5), 'AS OF '.$enddate);
							
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-7).':F'.($row-7))->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-6).':F'.($row-6))->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-5).':F'.($row-5))->getFont()->setBold(true);
							
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-7).':F'.($row-7))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-6).':F'.($row-6))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-5).':F'.($row-5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							
							
							//$worksheet->setCellValue('B'.($row-2), 'Fund: General Fund - 100');
							$worksheet->setCellValue('D'.($row), 'P');
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-2))->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
							$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
							$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							
							//Add headers
							$worksheet->setCellValue('B'.($row-1), 'Account Title');
							$worksheet->setCellValue('C'.($row-1), 'Acct. No');
							$worksheet->setCellValue('E'.($row-1), 'Debit Balance');
							$worksheet->setCellValue('F'.($row-1), 'Credit Balance');
							
							//Headers set to bold
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-1))->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('C'.($row-1))->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('E'.($row-1))->getFont()->setBold(true);
							$objPHPExcel->getActiveSheet()->getStyle('F'.($row-1))->getFont()->setBold(true);
							
							//Headers aligned center
							$objPHPExcel->getActiveSheet()->getStyle('B'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyle('C'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyle('E'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							$objPHPExcel->getActiveSheet()->getStyle('F'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
							
							//select the preliminary trial balance
							$sql="SELECT * FROM Trial_Monthly ORDER BY account_code,account_code ASC;";
							$connection=Yii::app()->db;
							$command=$connection->createCommand($sql);
							$premodel=$command->query();
						
						foreach($premodel as $data){
							$worksheet->setCellValue('B'.$row, $data['account_title']);
							$worksheet->setCellValue('C'.$row, $data['account_code']);
							$worksheet->setCellValue('E'.$row, number_format($data['debit_balance'],2,".",","));
							$worksheet->setCellValue('F'.$row, number_format($data['credit_balance'],2,".",","));
							
							$total_d = $total_d + $data['debit_balance'];
							$total_c = $total_c + $data['credit_balance'];
							
							if($data['debit_balance'] == 0){
								$worksheet->setCellValue('E'.$row, '');
							}
							
							if($data['credit_balance'] == 0){
								$worksheet->setCellValue('F'.$row, '');
							}
							
							$row = $row + 1;
						}
						
						//Total Debit and Credit
						$worksheet->setCellValue('D'.($row), "P");
						$worksheet->setCellValue('E'.($row), number_format($total_d,2,".",","));
						$worksheet->setCellValue('F'.($row), number_format($total_c,2,".",","));
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row))->getFont()->setBold(true);
						$objPHPExcel->getActiveSheet()->getStyle('F'.($row))->getFont()->setBold(true);
								
						//Certification
						
						//Merge cells
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.($row+2).':F'.($row+2));
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.($row+4).':F'.($row+4));
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.($row+5).':F'.($row+5));
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.($row+6).':F'.($row+6));
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.($row+7).':F'.($row+7));
						$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.($row+8).':F'.($row+8));
						
						//Alignment of Cells
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+2).':F'.($row+2))
								    ->getAlignment()
								    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);		
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+4).':F'.($row+4))
								    ->getAlignment()
								    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+5).':F'.($row+6))
								    ->getAlignment()
								    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+6).':F'.($row+6))
								    ->getAlignment()
								    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+7).':F'.($row+7))
								    ->getAlignment()
								    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+8).':F'.($row+8))
								    ->getAlignment()
								    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
						
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+2).':F'.($row+2))->getFont()->setItalic(true);
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+5).':F'.($row+5))->getFont()->setBold(true);
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+6).':F'.($row+6))->getFont()->setBold(true);
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+7).':F'.($row+7))->getFont()->setBold(true);
						$objPHPExcel->getActiveSheet()->getStyle('E'.($row+8).':F'.($row+8))->getFont()->setBold(true);
						
						$worksheet->setCellValue('E'.($row+2), "Certified Correct:");
						$worksheet->setCellValue('E'.($row+5), "LOLITA M. LEVISTE, CPA");
						$worksheet->setCellValue('E'.($row+6), "Municipal Accountant");
						$worksheet->setCellValue('E'.($row+7), date('F d, Y'));
						$worksheet->setCellValue('E'.($row+8), "Date");
							
						//Autosize specified range of comlumns
						foreach(range('B','F') as $columnID) {
							$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
										->setAutoSize(true);
						}
						
						$styleArray = array(
							'borders' => array(
								'allborders' => array(
									'style' => PHPExcel_Style_Border::BORDER_THIN
								)
							)
						);
						
						$objPHPExcel->getActiveSheet()->getStyle('B8:F'.$row)->applyFromArray($styleArray);
						unset($styleArray);
									
						// Rename worksheet
						$objPHPExcel->getActiveSheet()->setTitle('Trial Balance'.date('m-d-Y'));
								 
								 
						// Set active sheet index to the first sheet, so Excel opens this as the first sheet
						$objPHPExcel->setActiveSheetIndex(0);
								 
						// Redirect output to a client’s web browser (Excel5)
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						ob_end_clean();
						header('Content-Type: application/vnd.ms-excel');
						header('Content-Disposition: attachment;filename="Trial Balance ('.date('m-d-Y').').xls"');
						header('Cache-Control: max-age=0');
						// If you're serving to IE 9, then the following may be needed
						header('Cache-Control: max-age=1');
								 
						// If you're serving to IE over SSL, then the following may be needed
						header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
						header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
						header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
						header ('Pragma: public'); // HTTP/1.0
								 
						//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
						$objWriter->save('php://output');
						
						//record to audit trail
								$user = Yii::app()->db->createCommand()
									->insert('audit_trail', array(
									    'date'=>new CDbExpression('NOW()'),
									    'amount_involved'=>$total_c,
									    'activity'=>"Closed Month",
										'user'=>Yii::app()->user->id,
									));
										
									Yii::app()->end();
										
					}//excel
				}//check if $status is 1
			}//check end date if empty
			
			$this->redirect(array('JournalEntry/admin'));
		}//close month
		
		/*
		//close month option
		if(isset($_POST['closenotMonth']))
		{
			//change accept_status to open
			$user = Yii::app()->db->createCommand()
							->update('status_holder', array('accept_status'=>new CDbExpression(0)), 'constant_id=1', array('constant_id' => 1));
							
			$this->redirect(array('JournalEntry/admin'));
		}
		*/
		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return TrialBalance the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=TrialBalance::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param TrialBalance $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='trial-balance-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
