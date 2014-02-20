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
		global $T;
		extract($T);
		
		$html = '';
		
		ob_start();
		
		include('templates/header.php');
		include('templates/'. $templateName .'.php');
		include('templates/footer.php');
		
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
		
		$T['states'] = RollSaleManager::getStatesInfo();
		
		
		$templateName = __FUNCTION__;
		return $this->compose($templateName);
	}
	
	private function pageList() {
		global $T;
		
		$T['entries'] = RollSaleManager::getAll();
		$T['entries'] = RollSaleManager::getManagerName($T['entries']);
		
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
		global $T;
		
		$content = RollSaleManager::generateListReportXls();
		$filename = time() . '_list.xls';
		
		$headers = array(
			"Content-Type: application/vnd.ms-excel",
			"Content-Disposition: attachment; filename=$filename",
			"Pragma: no-cache",
			"Expires: 0"
		);
		
		return $this->headers($headers,$content);
	}
	
	private function pageExport_word_list() {
		
		$filename = time() . '_list.doc';
		$headers = array(
			"Content-type: application/vnd.ms-word",
			"Content-Disposition: attachment;Filename=" . $filename
		);
		$content = RollSaleManager::generateListReportDoc();
		
		return $this->headers($headers,$content);
	}
}
