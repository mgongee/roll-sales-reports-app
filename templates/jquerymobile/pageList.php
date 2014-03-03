
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
			<th></th>
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
			<td>
				<a id="delete-<?php echo $entry['id']?>" href="#popupConfirmDelete" data-mini="true" data-inline="true" data-theme="c" data-role="button" data-rel="popup">
					<span class="ui-btn-inner ui-btn-corner-all">
						<span class="ui-btn-text">Delete</span>
					</span>
				</a>
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

<div data-role="popup" id="popupConfirmDelete">
	<div class="ui-corner-top ui-header ui-bar-a" data-theme="a" data-role="header" role="banner">
		<h1 class="ui-title" role="heading" aria-level="1">Delete Entry?</h1>
	</div>
	<h3 class="ui-title">Are you sure you want to delete this entry?</h3>
	<p>This action cannot be undone.</p>
	<div class="ui-grid-b">
	<div class="ui-block-a">
		<a id="buttonDeleteClose" data-theme="c" data-inline="true" data-role="button" href="#" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-c"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">Cancel</span></span></a>
	</div>
	<div class="ui-block-b"></div>
	<div class="ui-block-c">
		<a id="buttonDeleteConfirm" data-theme="b" data-transition="flow" data-inline="true" data-role="button" href="#" data-corners="true" data-shadow="true" data-iconshadow="true" data-wrapperels="span" class="ui-btn ui-shadow ui-btn-corner-all ui-btn-inline ui-btn-up-b"><span class="ui-btn-inner ui-btn-corner-all"><span class="ui-btn-text">Delete</span></span></a>
	</div>
	</div><!-- /grid-b -->
</div>
