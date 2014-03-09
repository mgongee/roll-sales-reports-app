<!DOCTYPE html>
<html>
    <head>
        <title>Hardieracker</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--jquery mobile -->
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.css" />
		
        <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
        <script src="http://code.jquery.com/mobile/1.2.1/jquery.mobile-1.2.1.min.js"></script>

		<!-- for pie charts -->
		<link rel="stylesheet" href="bootstrap/css/jquery.jqplot.min.css" />
		<script src="bootstrap/js/jquery.jqplot.min.js"></script>
		<script src="bootstrap/js/jqplot.pieRenderer.min.js"></script>
		
		
		<!-- for this template-->
        <link rel="stylesheet" href="jquerymobile/stylesheet.css" />
        <script src="jquerymobile/script.js"></script>
    </head>
    <body>
	<div data-role="page">

		<div data-role="header" class="ui-header ui-bar-a" role="banner">
			<h1 class="ui-title" role="heading" aria-level="1">Hardietracker</h1>
			<div data-role="navbar">
				<ul>
					<?php echo RollSalePartialsJquerymobile::menu(); ?>
				</ul>
			</div><!-- /navbar -->
		</div>

		<div data-role="content">
			<div class="starter-template">
				<?php echo RollSalePartialsJquerymobile::messages($messages); ?>
			</div>
			