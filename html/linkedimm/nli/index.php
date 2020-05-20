<!DOCTYPE html>
<html>
<head>
    <title>LinkedImm A Linked Data Approach for Systems Vaccinology.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	 <link rel="stylesheet" href="style.css">
     <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>

	     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

<body>
<div class="spacer50">
  <p>&nbsp;</p>
</div>
<div class="container">
  <p><img src="images/logo.png" width="299" height="68"  alt=""/></p>
  <p>  A Linked Data Approach for Systems Vaccinology. <!-- CSS Styles -->
    <style>
  .speech {border: 1px solid #DDD; width: 1000px; padding: 0; margin: 0}
  .speech input {border: 1; width: 1000px; display: inline-block; height: 30px;}
  .speech img {float: right; width: 40px }
    </style>
  </p>
  <div class="row" align="left">
  <?php


require_once 'connection/vendor/autoload.php';


////////////Build a Cypher query here //////////////////



//////////////////////////////////////////////////////

use GraphAware\Neo4j\Client\ClientBuilder;

     //echo $client = ClientBuilder::create()->addConnection('default', 'http', '128.36.40.31', 7474, true, 'neo4j', 'linkedimm{300george}')->setAutoFormatResponse(true)->build();
//echo "test";

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:linkedimm@128.36.40.192:7474') // Example for HTTP connection configuration (port is optional)
    ->addConnection('bolt', 'bolt://neo4j:linkedimm@128.36.40.192:7687') // Example for BOLT connection configuration (port is optional)
	
    ->build();
	//$client->run('CREATE (n:Person)');
	
  ?>
    <form name="form1" method="GET" action="index.php">
       <div id="custom-search-input">
      <h4>Click on Mic to Speak  <img src="//i.imgur.com/cHidSVu.gif" width="46" height="41" onclick="startDictation()" /> or Type a Query</h4>  <h6>Sample Query: Plot male subjects over 40 years old </h6>                    

                                   <div class="speech" align="center">
    <input type="text" name="query" id="transcript" placeholder="Enter a Natural Language Query." required autofocus />
  
                                                            
                         </div> 
                            
</p>
<div align="center">

<table ><tr align="center" cellpadding="5" cellspacing="15"><td width="63"><button class="btn btn-primary" type="submit">
                                        Plot   <span class=" glyphicon glyphicon-search"></span>
                                    </button></td> <td width="313">    <h5><strong>
                                                                     
                                   
</td></table>
</div>
</form>
  <!-- HTML5 Speech Recognition API -->
<script>
  function startDictation() {

    if (window.hasOwnProperty('webkitSpeechRecognition')) {

      var recognition = new webkitSpeechRecognition();

      recognition.continuous = false;
      recognition.interimResults = false;

      recognition.lang = "en-US";
      recognition.start();

      recognition.onresult = function(e) {
        document.getElementById('transcript').value
                                 = e.results[0][0].transcript;
        recognition.stop();
       // document.getElementById('labnol').submit();
      };

      recognition.onerror = function(e) {
        recognition.stop();
      }

    }
  }
</script>
	<div class="spacer200"></div>
		<div class="spacer100"></div>
<div class="spacer200"></div>
  </div>


</div>
<div align="center"></div>
<?php
if(!empty($_GET['query'])) {
 $query_value = $_GET['query'];

//$query="plot female subjects greater than 50";
$buildquery = str_replace(' ', '%20', $query_value);
 $makecurl='https://api.dialogflow.com/v1/query?v=20170712&query='.$buildquery.'&lang=en&sessionId=2affa2ea-df49-7278-ffe4-b19bbb1cbd54&timezone=America/New_York';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $makecurl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml'));



$headers = array();
$headers[] = 'Authorization: Bearer f99e81bb17134c1a837436d1ccd90ff0';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}


curl_close ($ch);

//echo $result;

$abc=json_decode($result,true);

//print_r($abc);

//print_r($abc['result']['source']);

//print_r($abc['result']['resolvedQuery']);
$getgender=$abc['result']['parameters']['sex'];
$ageamount=$abc['result']['parameters']['age']['amount'];
$agecomparson=$abc['result']['parameters']['age_comp_op'];


$count=count($abc);
for($i=0; $i<$count; $i++){
print_r($cell=$abc[$i]);
print_r($cell->sex);
}}
else{}



$gender = $getgender; // number of simulation runs
 $age = $ageamount; // period of the simulation run


// open the file "demosaved.csv" for writing
 // save each row of the data
$file = fopen('queryresult.csv', 'w');

// save the column headers
fputcsv($file, array('s.accession', 'p.accession', 'p.age', 'p.gender', 'p.race'));
 
$query = "match (s:Study)-[:Has_subject]->(p:Subject) where  s.accession=s.accession and p.gender =~ '(?i)".$gender."' and p.race=p.race and  p.age".$agecomparson. $age." return  s.accession,p.accession,p.age,p.gender,p.race";

 //$query = "match (s:Study)-[:Has_subject]->(p:Subject) where  s.accession in "."[".$styaccession_final."]"." and p.gender in "."[".$gender_final."]"." and p.race in "."[".$race_final."]"."  return  s.accession,p.accession,p.age,p.gender,p.race";
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
	
 shell_exec("/usr/lib/R/bin/Rscript nli_dashboard.R");


	
?>


<div role="tabpanel" <?php if($stacc=='') echo "style=\"display:none\""?>>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#graph" aria-controls="home" role="tab" data-toggle="tab"><strong>Plot View</strong></a></li>
    <li role="presentation"><a href="#table" aria-controls="table" role="tab" data-toggle="tab"> <strong>Execution Process</strong></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" style="height:800px;"> 
    <div role="tabpanel" class="tab-pane active" id="graph" style="height:800px;">
    	<div class="tab-pane active" id="graph" style="height:800px;">&nbsp;
        <tabe align=center><tr align="center"><td align="center"> <img src=images/nli_plot.png alt=”R Graph” width="841" height="675" /></td></tr>
</table>
        </div>
    </div>
    <div role="tabpanel" class="tab-pane" id="table">
    	<table class="table"><tr><td><strong>Natural Language Query Retrieval</strong></td></tr>
       <tr><td> <?php echo  $query_value;?></td></tr>
      <tr><td> <strong>Calling to the DialogFlow API</strong></td></tr>
        <tr><td>  <?php print_r($abc); ?>  </td></tr> 
       
       <tr><td><strong>Dynamic Formulation of Cypher Query</strong></td></tr>
       <tr><td> <?php echo $query;?></td></tr>
       <td><tr> </td></tr>
      <tr><td> <strong>Plotting</strong><img src=images/nli_plot.png alt=”R Graph” width="300" height="250"/></td></tr></table>
        
    </div>
  </div>

  
</div>
</p></p></p></p></p></p></p></p></p></p></p></p></p></p></p></p>
	<div class="spacer200"></div>
		<div class="spacer100"></div>
<div align="center"></div>

</body>
</html>