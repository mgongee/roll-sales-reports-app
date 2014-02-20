<?php

class RollSalePartialsBootstrap {
	
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
	
	static public function statesSelect($selectedState = '') {
		global $CONF;
		$states = $CONF['states'];
		$html = "<option value=\"ALL\">All states</option>\r\n";
		foreach ($states as $state) {
			if ($state == $selectedState) {
				$selected = "selected=\"selected\" ";
				
			} else {
				$selected = "";
				
			}
			$html .= "<option $selected value=\"$state\">$state</option>\r\n";
		}
		return $html;
	}
	
	static public function messages($messages = '') {
	  if ((is_array($messages)) && (count($messages) > 0)) {
		foreach ($messages as $i => $message) {
				?>
		<div class="alert <?php echo $message['style']; ?> alert-dismissable">
		  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
		  <?php echo $message['text']; ?>
		</div>
			  <?php
			}
		}
	}
}


class RollSalePartialsJquerymobile {
	
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
			'list' => 'Summary',
		);
		
		$html = '';
		
		foreach ($menuItems as $itemName => $itemTitle) {
			if ($currentItem == $itemName) {
				$html .= '<li><a href="?route=' . $itemName . '" class="ui-btn-active ui-state-persist"> ' . $itemTitle . ' </a></li>' . "\r\n";
			}
			else {
				$html .= '<li><a href="?route=' . $itemName . '">' . $itemTitle . '</a></li>' . "\r\n";
			}
		}
		
		return $html;
	}
	
	static public function statesSelect($selectedState = '') {
		global $CONF;
		$states = $CONF['states'];
		$html = "<option value=\"ALL\">All states</option>\r\n";
		foreach ($states as $state) {
			if ($state == $selectedState) {
				$selected = "selected=\"selected\" ";
				
			} else {
				$selected = "";
				
			}
			$html .= "<option $selected value=\"$state\">$state</option>\r\n";
		}
		return $html;
	}
	
	
	static public function messages($messages = '') {
		
		if ((is_array($messages)) && (count($messages) > 0)) {
			echo ('<ul data-role="listview">');
			foreach ($messages as $i => $message) {
				?>
		  <li><?php echo $message['text']; ?></li>
		  
			  <?php
			}
			echo ('</ul>');
		}
	}
}