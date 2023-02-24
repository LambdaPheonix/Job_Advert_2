<?php

// files to import
//require "..\HTML_parts\Nav_bar_html_inside.php";
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
// create a filter that matches job_description against "PHP"
$php_filter = array(
array('field' => 'job_description', 'value' => ' ', 'operator' => 'exact')
);
// Retrieve adverts with filter
$vacancies = $client->getAdverts($session_id, $php_filter);
// dump the results
//var_dump($vacancies);

echo "<br>";
echo "<style>
        div { border: 5px solid black;
              padding: 20px;
              text-align: center;}
    </style>";

foreach($vacancies as $elem){
    ad_div_creation($elem);

}



