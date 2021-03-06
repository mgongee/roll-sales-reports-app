<?php

require_once './classes/PHPExcel.php';
require_once './classes/PHPExcel/Writer/Excel5.php';
require_once './classes/PHPExcel/Writer/Excel2007.php';


class StatesReportXlsWriter {
	
	public $data = array();


	
	static public $alphabet = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	
	static public $columnHeaders = array('State','Sales','Rolls');
	
	static public $columns = array(
		'State' => 0,
		'Sales' => 'sales',
		'Rolls' => 'rolls'
	);
	
	public $xlsData = false;

	public function __construct($data) {
		$this->data = $data;
	}
	
	public function prepare() {
		
		// Create new PHPExcel object
		
		$objPHPExcel = new PHPExcel();

		// Set properties
		$objPHPExcel->getProperties()->setCreator("rollsales-report-app");
		$objPHPExcel->getProperties()->setTitle("Sales by State");
		$objPHPExcel->getProperties()->setSubject("Sales by State");
		$objPHPExcel->getProperties()->setDescription("report generated by roll-sales app");


		// Add some data
		$objPHPExcel->setActiveSheetIndex(0);
/*
		$objPHPExcel->getActiveSheet()
			->fromArray(
				$this->fileContents,  // The data to set
				NULL,        // Array values with this value will not be set
				'A1'         // Top left coordinate of the worksheet range where
							 // we want to set these values (default is A1)
		);
*/
		$i = 1;
		
		foreach (self::$columnHeaders as $columnNumber => $columnHeader) {
			$address = self::$alphabet[$columnNumber] . ((string)$i);
			$value = $columnHeader;
				$objPHPExcel->getActiveSheet()->getCell($address)->setValueExplicit($value, PHPExcel_Cell_DataType::TYPE_STRING);
		}
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);

		foreach ($this->data as $stateName => $rowData) {
			$i++;
			foreach (self::$columnHeaders as $columnNumber => $columnHeader) {
				$address = self::$alphabet[$columnNumber] . ((string)$i);
				if (self::$columns[$columnHeader]) {
					$columnKey = self::$columns[$columnHeader];
					$value = $rowData[$columnKey];
				}
				else {
					$value = $stateName;
				}
				$objPHPExcel->getActiveSheet()->getCell($address)->setValueExplicit($value, PHPExcel_Cell_DataType::TYPE_STRING);
			}
		
		}
		
		$this->xlsData = $objPHPExcel;
		
	}
	
	public function writeAsExcel5($filename) {
		$this->prepare();
		// Save Excel 5 file
		$objWriter = new PHPExcel_Writer_Excel5($this->xlsData);
		$objWriter->save($filename);
		
		return true;
		
	}
	
	
	public function writeAsExcel2007($filename) {
		$this->prepare();
		// Save Excel 5 file
		$objWriter = new PHPExcel_Writer_Excel2007($this->xlsData);
		$objWriter->save($filename);
		
		return true;
		
	}
}