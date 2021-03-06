<?php

class RollSaleManager {
	
	static public function save($data) {
		
		global $DB;
		
		$savedFileName = RollSaleManager::saveUploadedFile('invoice_file');
		
		if (!isset($data['rebate'])) {
			$rebate = 0;
			$rebate_percentage = 0;
		}
		else {
			$rebate = 1;
			$rebate_percentage = round(floatval($data['rebate_percentage']),2);
		}
		
		$sql = "INSERT INTO `roll_sales` ( `manager_id`, `manager_name`, `state`, `rolls_sold`, `site_address`, `builder`, `distributor`, `rebate`, `rebate_percentage`, `invoice_file`, `created_at`) VALUES 
				( '" . intval($data['manager_id']) . "', 
				'" . mysql_real_escape_string($data['manager_name']) . "',
				'" . $data['state'] . "',
				'" . intval($data['rolls_sold']) . "',
				'" . mysql_real_escape_string($data['site_address']) . "',
				'" . mysql_real_escape_string($data['builder']) . "',
				'" . mysql_real_escape_string($data['distributor']) . "',
				'" . $rebate . "',
				'" . $rebate_percentage . "',
				'" . mysql_real_escape_string($savedFileName) . "',
				CURRENT_TIMESTAMP)";
		
		if ($DB->Execute($sql) === false) {
			global $T;
			$T['messages'][] = array(
				'style' => 'alert-danger',
				'text' => 'Failed to add entry'
			);
			throw new Exception(sprintf('error inserting in DB: %s in %s. SQL QUERY: %s', $DB->ErrorMsg(), __METHOD__, $sql));
		}
		else {
			global $T;
			$T['messages'][] = array(
				'style' => 'alert-success',
				'text' => 'Entry successfully added'
			);
			return true;
		}
	}
	
	static public function getAll() {
		global $DB;
		$rows = array();
		$rs = $DB->Execute("SELECT * FROM `roll_sales`");
		while ($array = $rs->FetchRow()) {
			$rows[] = $array;
		}
		return $rows;
	}
	
	static public function getByState($state) {
		global $DB;
		$rows = array();
		$state = mysql_real_escape_string($state);
		$rs = $DB->Execute("SELECT * FROM `roll_sales` WHERE state = '$state'");
		while ($array = $rs->FetchRow()) {
			$rows[] = $array;
		}
		return $rows;
	}
	
	static public function getCountInEachState() {
		global $DB;
		$rows = array();
		$rs = $DB->Execute("SELECT state, count(*) from `roll_sales` GROUP BY state");
		while ($array = $rs->FetchRow()) {
			$rows[] = $array;
		}
		return $rows;
	}
	
	static public  function saveUploadedFile($fieldName) {

		global $CONF;
		
		if (isset($_FILES[$fieldName]) && ($_FILES[$fieldName]['size'] > 0)){ //process uploaded file

			$filePath = $CONF['upload_dir'] . DIRECTORY_SEPARATOR . time() . '_' . $_FILES[$fieldName]['name'];
			$uploadFile = dirname(__FILE__) . DIRECTORY_SEPARATOR . $filePath;

			if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile) ) {
				return $filePath;
			}
			else {
				global $T;
				$T['messages'][] = array(
					'style' => 'alert-danger',
					'text' => 'Failed to save uploaded file'
				);
				throw new Exception(sprintf('Error when processing the uploaded file %s into %s', $_FILES[$fieldName]['name'], $filePath));
			}
		}
	}
	
	static public  function getStatesInfo() {
		global $DB;
		global $CONF;
		
		$statesList = $CONF['states'];
		
		$statesInfo = array();
		foreach ($statesList as $state) {
			$rs = $DB->Execute("SELECT COUNT(*) AS sales, SUM(`rolls_sold`) AS rolls FROM `roll_sales` where `state` = '$state'");
			$statesInfo[$state] = $rs->FetchRow();
		}
		return $statesInfo;
	}
	
		
	static public  function makePieChartStats($statesData) {
		global $DB;
		
		$pieChartStats = array();
		
		foreach ($statesData as $state => $stateData) {
			$pieChartStats[] = array($state, $stateData['rolls'] ? intval($stateData['rolls']) : 0);
		}
		return $pieChartStats;
	}
	
	static public  function generateStatesReportXls() {
	
		global $CONF;
		$filePath = $CONF['reports_dir'] . DIRECTORY_SEPARATOR . time() . '_states.xls';
		$savePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $filePath;
		
		$statesInfo = self::getStatesInfo();
		$xlsWriter = new StatesReportXlsWriter($statesInfo);
		$xlsWriter->writeAsExcel5($savePath);
		
		return file_get_contents($savePath);
	}
	
	static public  function generateListReportXls($state = "") {
		global $CONF;
		$filePath = $CONF['reports_dir'] . DIRECTORY_SEPARATOR . time() . '_list.xls';
		$savePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . $filePath;
		
		if ($state) {
			$salesInfo = self::getByState($state);
		}
		else {
			$salesInfo = self::getAll();
		}
		
		$xlsWriter = new ListReportXlsWriter($salesInfo);
		$xlsWriter->writeAsExcel5($savePath);
		
		return file_get_contents($savePath);
	}
	
	static public  function generateListReportDoc($state = "") {
		
		if ($state) {
			$salesInfo = self::getByState($state);
		}
		else {
			$salesInfo = self::getAll();
		}
		
		$writer = new ListReportDocWriter($salesInfo);
		$content = $writer->write();
		
		return $content;
	}
	
	static public  function generateStatesReportDoc() {
		
		$statesInfo = self::getStatesInfo();
		$writer = new StateReportDocWriter($statesInfo);
		$content = $writer->write();
		
		return $content;
	}
	
	static public function delete($id) {
		global $DB;
		$rs = $DB->Execute("DELETE FROM `roll_sales` where id = " . intval($id) . " LIMIT 1");
		return (bool)$rs;
	}

}
?>
