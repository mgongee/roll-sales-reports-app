<?php

         include('adodb/adodb.inc.php');

         $db = ADONewConnection($dbdriver); # eg 'mysql' or 'postgres'

         $db->debug = true;

         $db->Connect($config['server'], $config['user'], $config['password'], $config['database']);

         $rs = $db->Execute('select * from roll_sales');

         print "<pre>";

         print_r($rs->GetRows());

         print "</pre>";

?>
