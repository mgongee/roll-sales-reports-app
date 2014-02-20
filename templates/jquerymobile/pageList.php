
<?php if (!$state) : ?>
	<h1>List of sales</h1>
<?php else: ?>
	<h1>List of sales with state &laquo;<?php echo $_GET['state'] ?>&raquo;</h1>
<?php endif; ?>

<hr>

<div id="mainContent">	  

<form id="filter-form" class="form-horizontal" method="GET" action="index.php">
	<fieldset>
	<input id="route" name="route" type="hidden" value="list"/>

	<select id="state" name="state" class="form-control" data-inline="true">
		<?php echo RollSalePartialsJquerymobile::statesSelect($_GET['state']); ?>
	</select>
	
	<input id="filter-button" name="filter-button" data-inline="true" type="submit" value="Filter"/>	
	</fieldset>
</form>



</div>
		
<table class="table-bordered">
	<thead>
		<tr>
			<th style="min-width: 100px">Manager</th>
			<th style="min-width: 100px">State</th>
			<th style="min-width: 100px">Site address</th>
			<th style="min-width: 100px">Builder</th>
			<th style="min-width: 100px">Distributor</th>
			<th style="min-width: 100px">Rebate</th>
			<th style="min-width: 100px">Invoice</th>
		</tr>
	</thead>
	<tbody>
	<?php
		foreach ($entries as $entry) {
		?>

		<tr>
			<td><?php echo $entry['manager_name']?></td>
			<td><?php echo $entry['state']?></td>
			<td><?php echo $entry['site_address']?></td>
			<td><?php echo $entry['builder']?></td>
			<td><?php echo $entry['distributor']?></td>
			<td><?php if ($entry['rebate']) : ?>
				<?php echo $entry['rebate_percentage']?>
				<?php endif; ?>
			</td>
			<td><?php if ($entry['invoice_file']) : ?>
				<a href="<?php echo $entry['invoice_file']?>" data-role="button" data-inline="true" data-ajax="false"><img src="jquerymobile/images/pdf-icon.png"/></a>
				<?php else: ?>
				No file
				<?php endif; ?>
			</td>
		</tr>
		<?php
		}
	?>
	</tbody>
</table>
			
</div>
    
<a data-ajax="false" href="?route=export_excel_list<?php echo $state ? "&state=$state" : ""; ?>" data-role="button" data-inline="true">Download Excel</a>
<a data-ajax="false" href="?route=export_word_list<?php echo $state ? "&state=$state" : ""; ?>" data-role="button" data-inline="true">Download Word</a>
