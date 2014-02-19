<?php


class ListReportDocWriter {
	
	public $data = array();

	static public $columnHeaders = array('Manager','State','Site address','Builder','Distributor','Rebate');
	
	static public $columns = array(
		'Manager' => 'manager_name',
		'State'	=> 'state',
		'Site address' => 'site_address',
		'Builder' => 'builder',
		'Distributor' => 'distributor',
		'Rebate' => 'rebate_percentage'
	);
	
	public $xlsData = false;

	public function __construct($data) {
		$this->data = $data;
	}
	
	
	public function write() {

		$content = "<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF8\">
<body>
<h1>Sales report</h1>
<br>
<br>
<p>
<table cellspacing='5' cellpadding='5' border='3'><tr>";
		foreach (self::$columnHeaders as $columnNumber => $columnHeader) {
			$content .= "<td><b>" . $columnHeader . "</b></td>";
		}

		$content .= "</tr>";

		foreach ($this->data as $rowData) {
			$content .= "<tr>";
			foreach (self::$columnHeaders as $columnNumber => $columnHeader) {

				if (self::$columns[$columnHeader]) {
					$columnKey = self::$columns[$columnHeader];
					$value = $rowData[$columnKey];
				}
				else {
					$value = '';
				}
				$content .= "<td>" . $value . "</td>";
			}
			$content .= "</tr>";
		}
		$content .= "</table></p>
</body>
</html>";
		return $content;
	}

}