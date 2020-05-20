<!DOCTYPE html>
<html>
<head>
    <title>LinkedImm A Linked Data Approach for Systems Vaccinology.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="style.css">
	     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
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
<form name="form1" method="GET" action="index.php">

<table width="46%" height="34" align="center" class="table" cellpadding="0" cellspacing="0" align="center">


<tr valign="bottom">
  <td width="120"><strong>Study Accession</strong></td><td width="165"> <select name="studyaccession" class="dropdown">
 <?php 
 
  $query = "match (s:Study)-[:Has_subject]->(p:Subject) return distinct s.accession";
$result = $client->run($query);
 foreach ($result->getRecords() as $record) {

 echo "<option value=".$record->value('s.accession').">". $record->value('s.accession')."</option>"; }?>
</select>  </td>


<td width="81"><strong>Gender</strong></td><td width="104"> <select name="gender">
  <?php  
  
   $gender_query = "match (s:Study)-[:Has_subject]->(p:Subject) return distinct p.gender";
$result_gender_query = $client->run($gender_query);
 foreach ($result_gender_query->getRecords() as $record) {
  
   echo "<option value=".$record->value('p.gender').">". $record->value('p.gender')."</option>";} ?>
</select>  </td>

<td width="63"><strong>Race</strong></td><td width="101"> <select name="race">
  <?php
  
  $query = "match (s:Study)-[:Has_subject]->(p:Subject) return distinct p.race";
$result = $client->run($query);
 foreach ($result->getRecords() as $record) {
  echo "<option value=".$record->value('p.race').">". $record->value('p.race')."</option>"; }?>
</select>  </td> <td width="1023"><input type="submit" value="Plot" class="btn btn-primary"/></td>
</tr></table>
	  </form>

<?php
 $styaccession = $_GET['studyaccession']; // number of beds / resources of the simulation
 $gender = $_GET['gender']; // number of simulation runs
 $race = $_GET['race']; // period of the simulation run


// open the file "demosaved.csv" for writing
 // save each row of the data
$file = fopen('demosaved.csv', 'w');

// save the column headers
fputcsv($file, array('s.accession', 'p.accession', 'p.age', 'p.gender', 'p.race'));
 


$query = "match (s:Study)-[:Has_subject]->(p:Subject) where  s.accession="."'".$styaccession."'"." and p.gender="."'".$gender."'"." and p.race="."'".$race."'"." return  s.accession,p.accession,p.age,p.gender,p.race";
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
	
 shell_exec("/Library/Frameworks/R.framework/Resources/bin/Rscript dashboard.R");


	
?>
<div class="spacer20"></div>
<div class="row">
<div class="col-lg-12">
</p></p></p>
</p></p></p>
<p align="center">
<p align="center">
<p align="center">
<p align="center">
<p align="center">
<div class="col-lg-12">

<tabe align=center><tr align="center"><td align="center"> <img src=test.png alt=”R Graph” width="450" height="450" /></td></tr>
</table>

<table width="517" height="97" align="center"><tr>
  <td width="98" height="44"><strong>Study Accession</strong></td>
  <td width="106"><strong>Subject Accession</strong></td>
  <td width="85"><strong>Age</strong></td>
  <td width="61"><strong>Gender</strong></td>
  <td width="143"><strong>Race</strong></td></tr>
  

<?php

 //$query = "match (s:Study)-[:Has_subject]->(p:Subject) return  s.accession,p.accession,p.age,p.gender,p.race";
$query = "match (s:Study)-[:Has_subject]->(p:Subject) where  s.accession="."'".$styaccession."'"." and p.gender="."'".$gender."'"." and p.race="."'".$race."'"." return  s.accession,p.accession,p.age,p.gender,p.race";
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

<hr>
<div align="center">

<div align="center"></div>
</body>
</html>