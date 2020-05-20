<?php

$files = glob('output/*'); // glob() function searches for all the path names matching pattern
foreach($files as $file){ 
  if(is_file($file))
    unlink($file); // delete
}

$nbeds = $_GET['nbeds']; // number of beds / resources of the simulation
$myrep = $_GET['myrep']; // number of simulation runs
$period = $_GET['period']; // period of the simulation run
$myIAT = $_GET['myIAT']; // Interarrival time


// execute R script from shell

 $output=shell_exec("/Library/Frameworks/R.framework/Resources/bin/Rscript myscript.R $nbeds $myrep $period $myIAT");
 echo $output;
 
 
 echo "<img src='output/output.png'>";

$files = scandir('./output/');

sort($files); 

foreach($files as $file){
   echo'<a href="output/'.$file.'">'.$file.'</a>';
echo '<br>';
}


?>