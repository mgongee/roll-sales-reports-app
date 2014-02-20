      <div class="page-header">
		<?php 
			if (!$state) : ?>
				<h1>List of sales</h1>
			<?php else: ?>
				<h1>List of sales with state &laquo;<?php echo $_GET['state'] ?>&raquo;</h1>
			<?php endif; ?>
      </div>

	<div class="row">
		<div class="col-md-3"></div>
        <div class="col-md-6">
			<!-- Select Basic -->
			<div class="form-group">
			  
			  <div class="col-md-8">
				<form id="filter-form" class="form-horizontal" method="GET" action="index.php">
					<fieldset>
					<input id="route" name="route" type="hidden" value="list"/>
		
					<select id="state" name="state" class="form-control">
						<?php echo RollSalePartials::statesSelect($_GET['state']); ?>
					</select>
					</fieldset>
				</form>
			  </div>
			  <div class="col-md-4">
				<input id="filter-button" name="filter-button" class="btn btn-primary" type="submit" value="Filter"/>
			  </div>
			</div>

			
		</div>
		<div class="col-md-3"></div>
	</div>
	<div class="row">
		<div class="col-md-12">`
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>Manager</th>
							<th>State</th>
							<th>Site address</th>
							<th>Builder</th>
							<th>Distributor</th>
							<th>Rebate</th>
							<th>Invoice</th>
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
								<a href="<?php echo $entry['invoice_file']?>" class="btn btn-info btn-sm" role="button">Download</a>
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
		</div>
    </div>
    
	<hr>
	
	<div class="row">
        <div class="col-md-3"></div>
		<div class="col-md-3"><h3><a href="?route=export_excel_list<?php echo $state ? "&state=$state" : ""; ?>"><span class="label label-success">Download Excel</span></a></h3></div>
		<div class="col-md-3"><h3><a href="?route=export_word_list<?php echo $state ? "&state=$state" : ""; ?>"><span class="label label-info">Download Word</span></a></h3></div>
        <div class="col-md-3"></div>
    </div>