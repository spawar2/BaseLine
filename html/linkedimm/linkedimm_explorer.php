<!DOCTYPE html>
<html>
<head>
    <title>LinkedImm A Linked Data Approach for Systems Vaccinology.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="style.css">
	  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<script src="script.js"></script>


  </head>

  <body>
  
  
<div class="container">
<p>
<p><img src="images/logo.png" width="350" height="98"  alt=""/><strong><em>DASHBOARD</em></strong></p>
<p>&nbsp;</p>
<p>Please select from dropdown menu to plot.</p>

<?php


require_once 'connection/vendor/autoload.php';


////////////Build a Cypher query here //////////////////



//////////////////////////////////////////////////////

use GraphAware\Neo4j\Client\ClientBuilder;

     //echo $client = ClientBuilder::create()->addConnection('default', 'http', '128.36.40.31', 7474, true, 'neo4j', 'linkedimm{300george}')->setAutoFormatResponse(true)->build();
//echo "test";

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:linkedimm{300george}@128.36.40.31:7474') // Example for HTTP connection configuration (port is optional)
    ->addConnection('bolt', 'bolt://neo4j:linkedimm{300george}@128.36.40.31:7687') // Example for BOLT connection configuration (port is optional)
	
    ->build();
	//$client->run('CREATE (n:Person)');
	
  ?>
<form name="form1" method="GET" action="linkedimm_explorer.php">

<table width="89%" height="34" align="center" class="table">

<tr valign="bottom">
  <td width="282"><strong>Study Accession</strong></td>
  <td width="89">  
  <div class="form-group">
 <select id="studyaccession" name="studyaccession[]" multiple >
 <?php 
 
  $query = "match (s:Study)-[:Has_subject]->(p:Subject) return distinct s.accession";
$result = $client->run($query);
 foreach ($result->getRecords() as $record) {
	?> 

<option <?php  

if(!empty($_GET['studyaccession'])) {
 $value = '';
foreach($_GET['studyaccession'] as $val){
if($val==$record->value('s.accession')) echo "selected"; }}?> value=<?php echo $record->value('s.accession');?> > <?php echo $record->value('s.accession');}?> </option>
</select>  </td>

</div>
<td width="72"><strong>Gender</strong></td><td width="63"> <select id="gender" name="gender[]" multiple>
  <?php  
  
   $gender_query = "match (s:Study)-[:Has_subject]->(p:Subject) return distinct p.gender";
$result_gender_query = $client->run($gender_query);
 foreach ($result_gender_query->getRecords() as $record) {?>
 
 <option 
 <?php
 if(!empty($_GET['gender'])) {
 $value = '';
foreach($_GET['gender'] as $val){
if($val==$record->value('p.gender')) echo "selected"; }}?> 
 
value=<?php echo $record->value('p.gender');?>>  <?php echo $record->value('p.gender');}?></option>
 
 </select>  </td>

<td width="32"><strong>Race</strong></td><td width="80"> <select id="race" name="race[]" multiple>
  <?php
  
  $query = "match (s:Study)-[:Has_subject]->(p:Subject) return distinct p.race";
$result = $client->run($query);
 foreach ($result->getRecords() as $record) {
	 ?>
	 
<option 
 <?php
 if(!empty($_GET['race'])) {
 $value = '';
foreach($_GET['race'] as $val){
if($val==$record->value('p.race')) echo "selected"; }}?> 
 
value=<?php echo $record->value('p.race');?>>  <?php echo $record->value('p.race');}?></option>
  
  
  
</select>  </td> <td width="1009"><input type="submit" value="Plot" class="btn btn-primary"/></td>
</tr></table>
	  </form>

<?php
// $styaccession = $_GET['studyaccession']; // number of beds / resources of the simulation3
 
 if(!empty($_GET['studyaccession'])) {
 $value = '';
foreach($_GET['studyaccession'] as $val){
    $value .= "'".$val."',";// Result: based on user input like:10,11,12,13,14
}
$styaccession_final=rtrim($value, ',');

 }
 else
 {
$styaccession_final="s.accession";	 

}

if(!empty($_GET['gender'])) {
 $gender_value = '';
foreach($_GET['gender'] as $val){
    $gender_value .= "'".$val."',";// Result: based on user input like:10,11,12,13,14
}
$gender_final=rtrim($gender_value, ',');

 }
 else
 {
$gender_final="p.gender";	 

}

if(!empty($_GET['race'])) {
 $race_value = '';
foreach($_GET['race'] as $val){
    $race_value .= "'".$val."',";// Result: based on user input like:10,11,12,13,14
}
$race_final=rtrim($race_value, ',');

 }
 else
 {
$race_final="p.race";	 

}



 $gender = $_GET['gender']; // number of simulation runs
 $race = $_GET['race']; // period of the simulation run


// open the file "demosaved.csv" for writing
 // save each row of the data
$file = fopen('demosaved.csv', 'w');

// save the column headers
fputcsv($file, array('s.accession', 'p.accession', 'p.age', 'p.gender', 'p.race'));
 


 $query = "match (s:Study)-[:Has_subject]->(p:Subject) where  s.accession in "."[".$styaccession_final."]"." and p.gender in "."[".$gender_final."]"." and p.race in "."[".$race_final."]"."  return  s.accession,p.accession,p.age,p.gender,p.race";
$result = $client->run($query);
foreach ($result->getRecords() as $record) {
	
$stacc=$record->value('s.accession');
$pacc=$record->value('p.accession');
$page=$record->value('p.age');
$pgender=$record->value('p.gender');
$prace=$record->value('p.race');

// Sample data. This can be fetched from mysql too
$data= array(array($stacc,$pacc,$page,$pgender,$prace));
 
fputcsv($file, $data[0]);

}

// Close the file
	//echo "/Library/Frameworks/R.framework/Resources/bin/Rscript dashboard.R $stacc ";
	
 shell_exec("/usr/lib/R/bin/Rscript dashboard.R");


	
?>


<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#graph" aria-controls="home" role="tab" data-toggle="tab"><strong>Plot View</strong></a></li>
    <li role="presentation"><a href="#table" aria-controls="table" role="tab" data-toggle="tab"> <strong>Data View</strong></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" style="height:800px;"> 
    <div role="tabpanel" class="tab-pane active" id="graph" style="height:800px;">
    	<div class="tab-pane active" id="graph" style="height:800px;">&nbsp;
        <tabe align=center><tr align="center"><td align="center"> <img src=plots/test.png alt=”R Graph” width="877" height="799" /></td></tr>
</table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="table">
    	<table width="517" height="97" align="center" class="table"><tr>
  <td width="98" height="44"><strong>Study Accession</strong></td>
  <td width="106"><strong>Subject Accession</strong></td>
  <td width="85"><strong>Age</strong></td>
  <td width="61"><strong>Gender</strong></td>
  <td width="143"><strong>Race</strong></td></tr>
  

<?php

 //$query = "match (s:Study)-[:Has_subject]->(p:Subject) return  s.accession,p.accession,p.age,p.gender,p.race";
$query = "match (s:Study)-[:Has_subject]->(p:Subject) where  s.accession in "."[".$styaccession_final."]"." and p.gender in "."[".$gender_final."]"." and p.race in "."[".$race_final."]"."  return  s.accession,p.accession,p.age,p.gender,p.race";
$result = $client->run($query);
foreach ($result->getRecords() as $record) {

	//print_r($record);
	//echo '<pre>' . var_export($record, true) . '</pre>';
	//echo $record;
	
   // echo 'NCBITAXON classes names are: ', $record->value('r1.virus_strain').PHP_EOL."</br>";
   ?><tr><td><?php echo $record->value('s.accession');?></td><td><?php echo $record->value('p.accession');?></td><td><?php echo $record->value('p.age');?></td><td><?php echo $record->value('p.gender');?></td><td><?php echo $record->value('p.race');?></td></tr>
<?php  }
	
	?>
    
   </table>
    </div>
  </div>

  
</div>

</body>
</html>