<?php


class StateReportDocWriter {
	
	public $data = array();

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
	
	
	public function write() {

		$content = "<html>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF8\">
<body>
<h1>State report</h1>
<br>
<br>
<p>
<table cellspacing='5' cellpadding='5' border='3'><tr>";
		foreach (self::$columnHeaders as $columnNumber => $columnHeader) {
			$content .= "<td><b>" . $columnHeader . "</b></td>";
		}

		$content .= "</tr>";

		foreach ($this->data as $stateName => $rowData) {

			foreach (self::$columnHeaders as $columnNumber => $columnHeader) {

				if (self::$columns[$columnHeader]) {
					$columnKey = self::$columns[$columnHeader];
					$value = $rowData[$columnKey];
				}
				else {
					$value = $stateName;
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