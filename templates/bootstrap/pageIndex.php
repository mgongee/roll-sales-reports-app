      
	<div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">
                    <small>Welcome,</small>
					<?php echo $manager ?>
                </h1>
            </div>

        </div>
	<div class="page-header">
        <h1>Sales by state</h1>
    </div>
    
	<hr>
	
	<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>State</th>
							<th>Rolls Sold</th>
							<th>Sales</th>
						</tr>
					</thead>
					<tbody>
					<?php
						foreach ($states as $stateName => $stateInfo) {
						?>
						
						<tr>
							<td><?php echo $stateName?></td>
							<td><?php echo $stateInfo['rolls']?></td>
							<td><?php echo $stateInfo['sales']?></td>
						</tr>
						<?php
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
        <div class="col-md-3"></div>
    </div>
    
	<hr>
	
	<div class="row">
        <div class="col-md-3"></div>
		<div class="col-md-3"><h3><a href="?route=export_excel_states"><span class="label label-success">Download Excel</span></a></h3></div>
		<div class="col-md-3"><h3><a href="?route=export_word_states"><span class="label label-info">Download Word</span></a></h3></div>
        <div class="col-md-3"></div>
    </div>