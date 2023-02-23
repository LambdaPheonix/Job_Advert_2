<?php
// imported files
require "..\HTML_parts\Nav_bar_html_inside.php";
require "General_functions.php";
require "Session.php";
// define WSDL location
$wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
// provided by Parallel Software
$username = 'parallel';
$password = 'parallel';
$soap_args = array(
'exceptions' => true,
'cache_wsdl' => WSDL_CACHE_NONE,
'soap_version' => SOAP_1_1,
'trace' => 1
);
// create SOAP Client
$client = new SoapClient($wsdl, $soap_args);
// Authenticate with username and password
$session_id = $client->login($username, $password);
// Retrieve inactive adverts since UNIX epoch
$adverts = $client->getUnpublishedAdverts($session_id, "2020-01-01 00:00:00");
// dump the results
//var_dump($adverts);
// php inactive_adverts.php


echo $ads_date;




foreach($adverts as $elem){
    $dump = json_encode($elem);
    echo "<br>"."<br>".$dump;
}
