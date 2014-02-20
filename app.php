<?php

         include('adodb/adodb.inc.php');
		 include('config.inc.php');
		 include('roll-sale.class.php');
		 include('controller.class.php');
		 include('partials.class.php');
		 
		 include('state-xls-writer.class.php');
		 include('state-doc-writer.class.php');
		 
		 include('list-xls-writer.class.php');
		 include('list-doc-writer.class.php');

		 global $DB;
		 global $ROUTE;
		 global $CONF; // configuration
		 global $T; // variables sent to the template
		 
		 $CONF = $config;
		 $T = array(
			 'manager_id' => 45,
			 'manager' => 'John Doe',
			 'messages' => array()
		 );
		 
         $DB = ADONewConnection('mysql'); # eg 'mysql' or 'postgres'

         $DB->debug = false;
		 $DB->Connect($CONF['mysql_server'], $CONF['mysql_user'], $CONF['mysql_password'], $CONF['mysql_database']);

		 $controller = new RollSaleController();
		 
		 $controller->route();
		 /*
         print "<pre>";

         print_r($rows);

         print "</pre>";
*/
?>
