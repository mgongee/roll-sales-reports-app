roll-sales-reports-app
======================

Simple app for entering reports about roll sales.

You can add new entries, list all entries or filter ones of selected state, view summary for all states

This app uses an ADO framework for DB access.

Features:
* File uploads
* Filtering entries by state
* Form Validation
* Exports in Word & Excel format
* Theming: you can choose between Twitter Bootstrap and JQuery Mobile

INSTALLATION:

1) Create a MySQL table:


CREATE TABLE IF NOT EXISTS `roll_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` int(10) unsigned NOT NULL,
  `manager_name` varchar(50) NOT NULL,
  `state` enum('NSW','VIC','QLD','WA','TAS','SA','ACT') NOT NULL,
  `rolls_sold` int(8) NOT NULL,
  `site_address` varchar(255) NOT NULL,
  `builder` varchar(255) NOT NULL,
  `distributor` varchar(255) NOT NULL,
  `rebate` tinyint(1) NOT NULL,
  `rebate_percentage` float NOT NULL,
  `invoice_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

2) create config.inc.php based on the config-sample.inc.php
3) make sure that reports & uploads dir are writable.