      <div class="page-header">
        <h1>List of sales</h1>
      </div>

	<div class="row">
        <div class="col-md-12">
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
		<div class="col-md-3"><h3><a href="?route=export_excel_list"><span class="label label-success">Export Excel</span></a></h3></div>
		<div class="col-md-3"><h3><a href="?route=export_word_list"><span class="label label-info">Export Word</span></a></h3></div>
        <div class="col-md-3"></div>
    </div>