<?php

class RollSalePartials {
	
	static public function menu() {
		
		global $ROUTE;
		
		if (!$ROUTE) {
			$currentItem = 'index';
		} 
		else {
			$currentItem = $ROUTE;
		}
		$menuItems = array(
			'index' => 'Home',
			'add' => 'Add Entry',
			'list' => 'All Reports',
		);
		
		$html = '';
		
		foreach ($menuItems as $itemName => $itemTitle) {
			if ($currentItem == $itemName) {
				$html .= '<li class="active"><a href="?route=' . $itemName . '"> ' . $itemTitle . ' </a></li>' . "\r\n";
			}
			else {
				$html .= '<li><a href="?route=' . $itemName . '">' . $itemTitle . '</a></li>' . "\r\n";
			}
		}
		
		return $html;
	}
}