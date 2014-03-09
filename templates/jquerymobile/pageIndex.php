
	<h1 class="page-header">
		<small>Welcome,</small>
		<?php echo $manager_name ?>
	</h1>

	<h1>Sales by state</h1>
    
	<div id="piechart" style="width:600px;height:260px;"></div>
	<script>
		$(document).ready(function(){
			/*
			 * ['Heavy Industry', 12],['Retail', 9], ['Light Industry', 14],
				['Out of home', 16], ['Commuting', 7], ['Orientation', 9]
			 */
			var data = <?php echo $piechart_data; ?>;
			var plot1 = jQuery.jqplot('piechart', [data],
					{
						seriesDefaults: {
							// Make this a pie chart.
							renderer: jQuery.jqplot.PieRenderer,
							rendererOptions: {
								// Put data labels on the pie slices.
								// By default, labels show the percentage of the slice.
								showDataLabels: true
							}
						},
						legend: {show: true, location: 'e'}
					}
			);
		  });
	</script>
	
	<div id="mainContent">
		<div class="ui-grid-b">
			<div class="ui-block-a">
				<div data-role="header"> 
					<h3>State</h3> 
				</div> 
			</div>
			<div class="ui-block-b">
				<div data-role="header"> 
					<h3>Rolls Sold</h3> 
				</div> 
			</div>
			<div class="ui-block-c">
				<div data-role="header"> 
					<h3>Sales</h3> 
				</div> 
			</div>
		</div><!-- /grid-b -->

		<?php foreach ($states as $stateName => $stateInfo):?>

			<div class="ui-grid-b table-data">
				<div class="ui-block-a">
						<h3><?php echo $stateName?></h3> 
				</div>
				<div class="ui-block-b">
						<h3><?php echo $stateInfo['rolls']?></h3> 
				</div>
				<div class="ui-block-c">
					<h3><?php echo $stateInfo['sales']?></h3> 
				</div>
			</div><!-- /grid-b -->

			<?php endforeach; ?>

	</div>
	
	<a target="_blank" href="?route=export_excel_states" data-role="button" data-inline="true">Download Excel</a>
	<a target="_blank" href="?route=export_word_states" data-role="button" data-inline="true">Download Word</a>
	