<?php

class RollSaleController {
	
	public function route() {
		
		try {
			$route = isset($_GET['route']) ? $_GET['route'] : 'index';
			$methodName = 'page' . ucfirst($route);
			global $ROUTE;

			if(method_exists($this, $methodName)) {
				$ROUTE = $route;
				echo $this->$methodName(); // process and echo the templates
			} 
			else {
			  throw new Exception(sprintf('The required method "%s" does not exist for %s', $methodName, get_class($this)));
			}
		}
		catch (Exception $e) {
			global $T;
			$T['e'] = $e;

			echo $this->compose('pageError');
		} 
	}

	public function compose($templateName) {
		global $CONF;
		global $T;
		extract($T);
		
		$html = '';
		
		ob_start();
		
		$templateDir = 'templates' . DIRECTORY_SEPARATOR . $CONF['theme'] . DIRECTORY_SEPARATOR;
		
		include($templateDir . 'header.php');
		include($templateDir . $templateName .'.php');
		include($templateDir . 'footer.php');
		
		$html = ob_get_contents();
		ob_end_clean();
		
		return $html;
	}
	
	public function headers($headers,$content) {
		global $T;
		extract($T);
		
		foreach ($headers as $header) {
			header($header);
		}
		echo $content;
		
		die();
	}

	
	private function pageIndex() {
		global $T;
		
		$states_data =  RollSaleManager::getStatesInfo();
		$piechart_data = RollSaleManager::makePieChartStats($states_data);
		
		$T['states'] = $states_data;
		$T['piechart_data'] = json_encode($piechart_data);
		
		$templateName = __FUNCTION__;
		return $this->compose($templateName);
	}
	
	private function pageList() {
		global $T;
		global $CONF;
		
		if ((!isset($_GET['state'])) || ($_GET['state'] == '')) {
			$state = '';		
		}
		elseif (in_array($_GET['state'],$CONF['states'])) {
			$state = $_GET['state'];
		}
		else {
			$state = '';	
		}
		
		if ($state) {
			$T['state'] = $state;
			$T['entries'] = RollSaleManager::getByState($state);
		}
		else {
			$T['state'] = '';
			$T['entries'] = RollSaleManager::getAll();
		}
		
		$templateName = __FUNCTION__;
		return $this->compose($templateName);
	}
	
	private function pageAdd() {
		$templateName = __FUNCTION__;
		
		if (isset($_POST['manager_id'])) {
			$result = RollSaleManager::save($_POST);
		}
		//$rows = RollSaleManager::getAll();
		
		return $this->compose($templateName);
	}

	private function pageExport_excel_states() {
		global $T;
		$content = RollSaleManager::generateStatesReportXls();
		$filename = time() . '_states.xls';
		
		$headers = array(
			"Content-Type: application/vnd.ms-excel",
			"Content-Disposition: attachment; filename=$filename",
			"Pragma: no-cache",
			"Expires: 0"
		);

		return $this->headers($headers, $content);
		return $this->compose('export');
	}
	
	private function pageExport_word_states() {
		
		$filename = time() . '_states.doc';
		$headers = array(
			"Content-type: application/vnd.ms-word",
			"Content-Disposition: attachment;Filename=" . $filename
		);
		$content = RollSaleManager::generateStatesReportDoc();
		
		return $this->headers($headers,$content);
	}
	
	private function pageExport_excel_list() {
		global $CONF;
		
		if ((!isset($_GET['state'])) || ($_GET['state'] == '')) {
			$state = '';		
		}
		elseif (in_array($_GET['state'],$CONF['states'])) {
			$state = $_GET['state'];
		}
		else {
			$state = '';	
		}
		
		if ($state) {
			$content = RollSaleManager::generateListReportXls($state);
			$filename = time() . '_list_' . $state . '.doc';
		}
		else {
			$content = RollSaleManager::generateListReportXls();
			$filename = time() . '_list.xls';
		}
		$headers = array(
			"Content-Type: application/vnd.ms-excel",
			"Content-Disposition: attachment; filename=$filename",
			"Pragma: no-cache",
			"Expires: 0"
		);
		return $this->headers($headers,$content);
	}
	
	private function pageExport_word_list() {
		global $CONF;
		
		if ((!isset($_GET['state'])) || ($_GET['state'] == '')) {
			$state = '';		
		}
		elseif (in_array($_GET['state'],$CONF['states'])) {
			$state = $_GET['state'];
		}
		else {
			$state = '';	
		}
		
		if ($state) {
			$filename = time() . '_list_' . $state . '.doc';
			$content = RollSaleManager::generateListReportDoc($state);

		}
		else {
			$filename = time() . '_list.doc';
			$content = RollSaleManager::generateListReportDoc();
		}
		
		$headers = array(
			"Content-type: application/vnd.ms-word",
			"Content-Disposition: attachment;Filename=" . $filename
		);
		
		return $this->headers($headers,$content);
	}
	
	private function pageDelete() {
		if (RollSaleManager::delete(intval($_GET['id']))) {
			return 'ok';
		}
		else {
			return 'fail';
		}
	}
}
