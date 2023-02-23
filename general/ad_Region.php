<?php
// starts session to move vars around and check logged status
session_start(); 

require "Nav_bar_html_inside.php";
require "General_functions.php";
// define WSDL location
$wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
// provided by Parallel Software
$username = 'parallel';
$password = 'parallel';
// create SOAP Client
$client = new SoapClient($wsdl);
// Authenticate with username and password
$session_id = $client->login($username, $password);
// Retrieve list of regions
$regions_response = $client->getAdvertRegions($session_id);
// Create an array representing the key-value pairs
$regions = array();
foreach($regions_response as $region)
{
$regions[$region->id] = $region->label;
}
// Create a regional filter
$regional_filter = array(
'Gauteng' => array(
'field' => 'region',
'operator' => '=',
'value' => array_search('Limpopo', $regions)
)
);
// retrieve vacancies
$vacancies_in = array();
$vacancies_in['Gauteng'] = $client->getAdverts(
$session_id,
array($regional_filter['Gauteng'])
);

// dump the results
var_dump($vacancies_in);

foreach($vacancies_in as $elem){
    $dump = json_encode($elem);
    echo "<br>"."<br>".$dump;
}