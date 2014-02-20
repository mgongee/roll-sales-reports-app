<form enctype="multipart/form-data" data-ajax="false" class="form-horizontal" method="POST" action="?route=add">
<fieldset>

<input id="manager_id" name="manager_id" type="hidden" value="<?php echo $manager_id; ?>">
	
<h2><small>Manager:</small> <?php echo $manager ?></h2>

<h1>Add New Entry</h1>
    
<div id="mainContent">

<!-- Text input-->
<label for="rolls_sold" class="ui-hidden-accessible">Rolls Sold:</label>
<input type="text" name="rolls_sold" id="rolls_sold" value="" placeholder="Rolls Sold"/>
           
<!-- Select Basic -->

<label for="state" class="select">State:</label>
<select name="state" id="state">
	<?php

	global $CONF;
	$statesList = $CONF['states'];
	foreach ($statesList as $state) {
		echo ("<option value=\"$state\">$state</option>");
	}
	?>
</select>

<br><br>
<!-- File Button --> 
<label class="col-md-4 control-label" for="invoice_file">Upload your Invoice</label>
<input id="invoice_file" name="invoice_file" class="input-file" type="file">
<br><br>

<!-- Text input-->
<label for="site_address" class="ui-hidden-accessible">Site Address:</label>
<input type="text" name="site_address" id="site_address" value="" placeholder="Site Address"/>

<!-- Text input-->
<label for="builder" class="ui-hidden-accessible">Builder:</label>
<input type="text" name="builder" id="builder" value="" placeholder="Builder"/>

<!-- Text input-->
<label for="distributor" class="ui-hidden-accessible">Distributor:</label>
<input type="text" name="distributor" id="distributor" value="" placeholder="Distributor"/>

<!-- Checkbox -->
<input type="checkbox" name="rebate" id="rebate" class="custom" />
<label for="rebate">Rebate</label>   
         
<label for="rebate_percentage">Rebate percentage:</label>
<input type="range" name="rebate_percentage" id="rebate_percentage" value="0" min="0" max="100" />

<button id="submit" name="submit" class="btn btn-success" type="submit">Save and submit</button>

</div>
</fieldset>
</form>

  