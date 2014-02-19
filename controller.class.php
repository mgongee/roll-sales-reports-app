<?php

class RollSaleController {
	
	public function route() {
		
		try {
			$route = isset($_GET['route']) ? $_GET['route'] : 'index';
			$methodName = 'page' . ucfirst($route);
			global $ROUTE;

			if(method_exists($this, $methodName)) {
				$ROUTE = $route;
				echo $this->$methodName();
			} 
			else {
			  throw new Exception(sprintf('The required method "%s" does not exist for %s', $method, get_class($this)));
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

	
	private function pageIndex() {
		global $T;
		
		$T['states'] = RollSaleManager::getStatesInfo();
		
		
		$templateName = __FUNCTION__;
		return $this->compose($templateName);
	}
	
	private function pageList() {
		global $T;
		
		$T['entries'] = RollSaleManager::getAll();
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

}