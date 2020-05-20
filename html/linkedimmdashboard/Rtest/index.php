<!-- add the link to bootstrap CSS and JS libraries -->

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<form class="form-horizontal" action="runr.php" method="get">

<fieldset>

<!-- Form Name -->

<legend>Insert Simulation Parameters</legend>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="nbeds">Number of beds:</label>  
  <div class="col-md-4">
  <input id="nbeds" name="nbeds" type="text" placeholder="Number of beds" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="myrep">Number of repetitions:</label>  
  <div class="col-md-4">
  <input id="myrep" name="myrep" type="text" placeholder="Number of runs" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="period">Period:</label>  
  <div class="col-md-4">
  <input id="period" name="period" type="text" placeholder="Period in days" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" for="myIAT">Inter Arrival Time:</label>  
  <div class="col-md-4">
  <input id="myIAT" name="myIAT" type="text" placeholder="Inter Arrival Time in Days." class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->

<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    
  <input type="submit" class="btn btn-info" value="Run Simulation">

  </div>
</div>

</fieldset>
</form>