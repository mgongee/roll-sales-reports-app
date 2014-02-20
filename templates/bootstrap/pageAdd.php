<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="?route=add">
<fieldset>

<input id="manager_id" name="manager_id" type="hidden" value="<?php echo $manager_id; ?>">
	
<!-- Form Name -->
<legend>ADD NEW ENTRY</legend>


<div class="form-group">
  <label class="col-md-4 control-label" for="rolls_sold"></label>  
  <div class="col-md-4">
	  <h2><small>Manager:</small> <?php echo $manager ?></h2>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="rolls_sold">Rolls</label>  
  <div class="col-md-4">
  <input id="rolls_sold" name="rolls_sold" placeholder="0" class="form-control input-md" required="" type="text">
  <span class="help-block">Number of rolls sold</span>  
  </div>
</div>
           
<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="state">State</label>
  <div class="col-md-4">
    <select id="state" name="state" class="form-control">
		<?php
		
		global $CONF;
		$statesList = $CONF['states'];
		foreach ($statesList as $state) {
			echo ("<option value=\"$state\">$state</option>");
		}
		?>
    </select>
  </div>
</div>

<!-- File Button --> 
<div class="form-group">
  <label class="col-md-4 control-label" for="invoice_file">Upload your Invoice</label>
  <div class="col-md-4">
    <input id="invoice_file" name="invoice_file" class="input-file" type="file">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="site_address">Site Address</label>  
  <div class="col-md-4">
  <input id="site_address" name="site_address" placeholder="Pumble Way, NSW 634" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="builder">Builder</label>  
  <div class="col-md-4">
  <input id="builder" name="builder" placeholder="McDonald Jones Homes, NSW 456" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="distributor">Distributor</label>  
  <div class="col-md-4">
  <input id="distributor" name="distributor" placeholder="Bunning, Castle Hill 242" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Prepended checkbox -->
<div class="form-group" id='rebate-group'>
  <label class="col-md-4 control-label" for="rebate">Rebate</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">     
          <input type="checkbox" id='rebate' name='rebate' value='1'>     
      </span>
      <input id="rebate" name="rebate_percentage" class="form-control" placeholder="" type="text">
	  
    </div>
    <span class="help-block">Enter percentage without %</span>  
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
	<button id="submit" name="submit" class="btn btn-success" type="submit">Save and submit</button>
  </div>
</div>

</fieldset>
</form>
