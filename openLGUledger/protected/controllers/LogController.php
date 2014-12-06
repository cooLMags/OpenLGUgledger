<!--
@Author: Edward B. Magsino
@emaill: edwardmagsino@ymail.com
-->

<?php

class LogController extends Controller
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
				'actions'=>array('admin', 'create'),
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
		$model=new Log;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['lan'])){
			if($_POST['lan']!=''){
			$accnum=$_POST['lan'];
			$sql="SELECT * FROM Ledger WHERE account_code = ".$accnum.";";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$lmodelcount=$command->queryScalar();
			}
		}
		
		if(isset($_POST['Log']))
		{
			$model->attributes=$_POST['Log'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->log_id));
		}
///		
	//Download Trial Balance Excel File
			$sql="SELECT * FROM Trial_Balance;";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$trialBmodelcount=$command->queryScalar();
		
			if(isset($_POST['TrialBalanceExcel']) && $trialBmodelcount!=0)
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
				$monthyear = strtoupper(date('F Y'));
					
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-7).':F'.($row-7));
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-6).':F'.($row-6));
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-5).':F'.($row-5));
					
					$worksheet->setCellValue('B'.($row-7), 'MUNICIPALITY OF LOS BANOS');
					$worksheet->setCellValue('B'.($row-6), 'PRELIMINARY TRIAL BALANCE');
					$worksheet->setCellValue('B'.($row-5), 'AS OF '.$monthyear);
					
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
					$sql="SELECT * FROM Trial_Balance ORDER BY account_code,account_code ASC;";
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
				//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
				header('Content-Disposition: attachment;filename="Accumulated Trial Balance ('.date('m-d-Y').').xls"');
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
						    'amount_involved'=>0,
						    'activity'=>"Downloaded Trial Balance Excel File",
							'user'=>Yii::app()->user->id,
						));
							
						Yii::app()->end();
							
			}
///JOURNAL
			if(isset($_POST['JournalEntryExcel'], $_POST['jfromdate'], $_POST['jtodate']))
			{
				$from = $_POST['jfromdate'];
				$to = $_POST['jtodate'];
				
			if(($from && $to)!=''){
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
				
				$row = 7;
				$rowinit = 7;
				$total_d = 0;
				$total_c = 0;
					
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-5).':I'.($row-5));
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-4).':I'.($row-4));
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-3).':I'.($row-3));
					
					$worksheet->setCellValue('B'.($row-5), 'MUNICIPALITY OF LOS BANOS');
					$worksheet->setCellValue('B'.($row-4), 'JOURNAL ENTRIES');
					$worksheet->setCellValue('B'.($row-3), 'FROM '.date("F j, Y", strtotime($from)).' to '.date("F j, Y", strtotime($to)));
					
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-5).':F'.($row-5))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-4).':F'.($row-4))->getFont()->setBold(true);
					
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-5).':F'.($row-5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-4).':F'.($row-4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-4).':F'.($row-4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$objPHPExcel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objPHPExcel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					//Add headers
					$worksheet->setCellValue('B'.($row-1), 'Date');
					$worksheet->setCellValue('C'.($row-1), 'Account Title');
					$worksheet->setCellValue('D'.($row-1), 'Acct. No');
					$worksheet->setCellValue('E'.($row-1), 'J Pg.');
					$worksheet->setCellValue('F'.($row-1), 'L Pg.');
					$worksheet->setCellValue('H'.($row-1), 'Debit');
					$worksheet->setCellValue('I'.($row-1), 'Credit');
					
					//Headers set to bold
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('C'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('D'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('E'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('F'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('G'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('H'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('I'.($row-1))->getFont()->setBold(true);
					
					//Headers aligned center
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('E'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('F'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('G'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('H'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('I'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$worksheet->setCellValue('G'.($row), "P");
					
					//select the particulars
					$sql="SELECT * FROM Particulars WHERE date between '".$from."' AND '".$to."';";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$jmodel=$command->query();
				
				foreach($jmodel as $data){		
				
					$worksheet->setCellValue('B'.$row, $data['date']);
					$worksheet->setCellValue('C'.$row, $data['account_title']);
					$worksheet->setCellValue('D'.$row, $data['account_code']);
					$worksheet->setCellValue('E'.$row, $data['journal_page']);
					$worksheet->setCellValue('F'.$row, $data['ledger_page']);
					$worksheet->setCellValue('H'.($row), number_format($data['debit'],2,".",","));
					$worksheet->setCellValue('I'.($row), number_format($data['credit'],2,".",","));
					
					$total_d = $total_d + $data['debit'];
					$total_c = $total_c + $data['credit'];
					
					if($data['debit'] == 0){
						$worksheet->setCellValue('H'.$row, '');
					}
					
					if($data['credit'] == 0){
						$worksheet->setCellValue('I'.$row, '');
					}
					
					$row = $row + 1;
				}
				
				//Total Debit and Credit
				$worksheet->setCellValue('G'.($row), "P");
				$worksheet->setCellValue('H'.($row), number_format($total_d,2,".",","));
				$worksheet->setCellValue('I'.($row), number_format($total_c,2,".",","));
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('I'.($row))->getFont()->setBold(true);
				
						
				//Certification
				//Merge cells
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.($row+2).':I'.($row+2));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.($row+4).':I'.($row+4));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.($row+5).':I'.($row+5));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.($row+6).':I'.($row+6));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.($row+7).':I'.($row+7));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('H'.($row+8).':I'.($row+8));
				
				//Alignment of Cells
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+2).':I'.($row+2))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);		
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+4).':I'.($row+4))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+5).':I'.($row+6))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+6).':I'.($row+6))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+7).':I'.($row+7))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+8).':I'.($row+8))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+2).':I'.($row+2))->getFont()->setItalic(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+5).':I'.($row+5))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+6).':I'.($row+6))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+7).':I'.($row+7))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('H'.($row+8).':I'.($row+8))->getFont()->setBold(true);
				
				$worksheet->setCellValue('H'.($row+2), "Certified Correct:");
				$worksheet->setCellValue('H'.($row+5), "LOLITA M. LEVISTE, CPA");
				$worksheet->setCellValue('H'.($row+6), "Municipal Accountant");
				$worksheet->setCellValue('H'.($row+7), date("F j, Y"));
				$worksheet->setCellValue('H'.($row+8), "Date");
				
				
				//Autosize specified range of comlumns
				foreach(range('B','G') as $columnID) {
					$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
								->setAutoSize(true);
				}
				$objPHPExcel->getActiveSheet()->getDefaultColumnDimension('H')
								->setWidth(20);
				$objPHPExcel->getActiveSheet()->getDefaultColumnDimension('I')
								->setWidth(20);
				
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
				
				$objPHPExcel->getActiveSheet()->getStyle('B6:I'.$row)->applyFromArray($styleArray);
				unset($styleArray);
				
				/*
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A1', 'Hello')
				            ->setCellValue('B2', 'world!')
				            ->setCellValue('C1', 'Hello')
				            ->setCellValue('D2', 'world!');
				*/		
							
				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Journal Entries');
						 
						 
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
						 
				// Redirect output to a client’s web browser (Excel5)
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				ob_end_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Journal Entries '.date('m-d-Y').'.xls"');
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
								    'amount_involved'=>0,
								    'activity'=>"Downloaded Journal Entries",
									'user'=>Yii::app()->user->id,
							));
							Yii::app()->end();
			
				//redirect to admin
				$this->redirect(array('admin','id'=>$model->error_log_id));
			}
		}
		
///LEDGER	
			else if(isset($_POST['LedgerExcel']) && $_POST['lan']!='' && $lmodelcount!=0)
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
				
				$row = 7;
				$rowinit = 7;
				$total_d = 0;
				$total_c = 0;
				
				$chosenLedg=Ledger::model()->find('account_code='.$accnum, array('account_code'=>$accnum));				
					
					
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-5).':G'.($row-5));
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-4).':G'.($row-4));
					$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.($row-3).':G'.($row-3));
					
					$worksheet->setCellValue('B'.($row-5), 'MUNICIPALITY OF LOS BANOS');
					$worksheet->setCellValue('B'.($row-4), $chosenLedg['account_code']." - ".$chosenLedg['account_title']);
					
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-5).':G'.($row-5))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-4).':G'.($row-4))->getFont()->setBold(true);
					
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-5).':G'.($row-5))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-4).':G'.($row-4))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					
					$objPHPExcel->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);		
					$objPHPExcel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
					$objPHPExcel->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
					//Add headers
					$worksheet->setCellValue('B'.($row-1), 'Date');
					$worksheet->setCellValue('C'.($row-1), 'J Pg.');
					$worksheet->setCellValue('D'.($row-1), 'L Pg.');
					$worksheet->setCellValue('F'.($row-1), 'Debit');
					$worksheet->setCellValue('G'.($row-1), 'Credit');
					
					//Headers set to bold
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('C'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('D'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('F'.($row-1))->getFont()->setBold(true);
					$objPHPExcel->getActiveSheet()->getStyle('G'.($row-1))->getFont()->setBold(true);
					//Headers aligned center
					$objPHPExcel->getActiveSheet()->getStyle('B'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('C'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('D'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('F'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$objPHPExcel->getActiveSheet()->getStyle('G'.($row-1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					
					$worksheet->setCellValue('E'.($row), "P");
					
					//select the ledger entries
					$sql="SELECT * FROM Ledger_Entries WHERE ledger_page = ".$chosenLedg['ledger_page'].";";
					$connection=Yii::app()->db;
					$command=$connection->createCommand($sql);
					$lmodel=$command->query();
					
				foreach($lmodel as $data){		
					
					$worksheet->setCellValue('B'.$row, $data['date']);
					$worksheet->setCellValue('C'.$row, $data['journal_page']);
					$worksheet->setCellValue('D'.$row, $data['ledger_page']);
					$worksheet->setCellValue('F'.$row, number_format($data['debit'],2,".",","));
					$worksheet->setCellValue('G'.$row, number_format($data['credit'],2,".",","));
					
					$total_d = $total_d + $data['debit'];
					$total_c = $total_c + $data['credit'];
					
					if($data['debit'] == 0){
						$worksheet->setCellValue('F'.$row, '');
					}
					
					if($data['credit'] == 0){
						$worksheet->setCellValue('G'.$row, '');
					}
					
					$row = $row + 1;
				}
				
				//Total Debit and Credit
				$worksheet->setCellValue('E'.($row), "P");
				$worksheet->setCellValue('F'.($row), number_format($total_d,2,".",","));
				$worksheet->setCellValue('G'.($row), number_format($total_c,2,".",","));
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('G'.($row))->getFont()->setBold(true);
				
						
				//Certification
				
				//Merge cells
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.($row+2).':G'.($row+2));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.($row+4).':G'.($row+4));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.($row+5).':G'.($row+5));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.($row+6).':G'.($row+6));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.($row+7).':G'.($row+7));
				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F'.($row+8).':G'.($row+8));
				
				//Alignment of Cells
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+2).':G'.($row+2))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);		
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+4).':G'.($row+4))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+5).':G'.($row+6))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+6).':G'.($row+6))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+7).':G'.($row+7))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);		
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+8).':G'.($row+8))
						    ->getAlignment()
						    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+2).':G'.($row+2))->getFont()->setItalic(true);
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+5).':G'.($row+5))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+6).':G'.($row+6))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+7).':G'.($row+7))->getFont()->setBold(true);
				$objPHPExcel->getActiveSheet()->getStyle('F'.($row+8).':G'.($row+8))->getFont()->setBold(true);
				
				$worksheet->setCellValue('F'.($row+2), "Certified Correct:");
				$worksheet->setCellValue('F'.($row+5), "LOLITA M. LEVISTE, CPA");
				$worksheet->setCellValue('F'.($row+6), "Municipal Accountant");
				$worksheet->setCellValue('F'.($row+7), date("F j, Y"));
				$worksheet->setCellValue('F'.($row+8), "Date");
				
				
				//Autosize specified range of comlumns
				foreach(range('B','E') as $columnID) {			
					$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
								->setAutoSize(true);
				}
				$objPHPExcel->getActiveSheet()->getDefaultColumnDimension('F')
								->setWidth(20);
				$objPHPExcel->getActiveSheet()->getDefaultColumnDimension('G')
								->setWidth(20);
								
					
				$styleArray = array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				);
				
				$objPHPExcel->getActiveSheet()->getStyle('B6:G'.$row)->applyFromArray($styleArray);
				unset($styleArray);
				
				/*
				// Add some data
				$objPHPExcel->setActiveSheetIndex(0)
				            ->setCellValue('A1', 'Hello')
				            ->setCellValue('B2', 'world!')
				            ->setCellValue('C1', 'Hello')
				            ->setCellValue('D2', 'world!');
				*/		
							
				// Rename worksheet
				$objPHPExcel->getActiveSheet()->setTitle('Ledger');
						 
						 
				// Set active sheet index to the first sheet, so Excel opens this as the first sheet
				$objPHPExcel->setActiveSheetIndex(0);
						 
				// Redirect output to a client’s web browser (Excel5)
				$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				ob_end_clean();
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="Ledger '.date('m-d-Y').'.xls"');
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
								    'amount_involved'=>0,
								    'activity'=>"Downloaded Ledgers",
									'user'=>Yii::app()->user->id,
							));
							
						Yii::app()->end();
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

		if(isset($_POST['Log']))
		{
			$model->attributes=$_POST['Log'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->log_id));
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
		$dataProvider=new CActiveDataProvider('Log');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Log('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Log']))
			$model->attributes=$_GET['Log'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Log the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Log::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Log $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='log-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
