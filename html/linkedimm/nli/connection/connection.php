<?php

require_once 'vendor/autoload.php';

use GraphAware\Neo4j\Client\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default', 'http://neo4j:ahmed786@localhost:7474') // Example for HTTP connection configuration (port is optional)
    ->addConnection('bolt', 'bolt://neo4j:ahmed786@localhost:7687') // Example for BOLT connection configuration (port is optional)
    ->build();
	//$client->run('CREATE (n:Person)');
	$query = "MATCH p=(a)-[r:SUBCLASSOF*]-(b)
WITH NODES(p) AS nodes
UNWIND nodes AS n
WITH n
WHERE n.label=~'.*Orthomyxo.*'
RETURN n limit 20;";
$result = $client->run($query);
foreach ($result->getRecords() as $record) {
	
	echo '<pre>' . var_export($record, true) . '</pre>';
	//var_dump($record);
    //echo sprintf('NCBITAXON classes names are: ', $record->label)."</br>";
}
	
	?>