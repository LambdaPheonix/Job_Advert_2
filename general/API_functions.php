<?php
// to store any functions used by the API

function createSoapClient($username = 'parallel',$password = 'parallel'){ // connects to SOAP API and returns a client.
    // define WSDL location
    $wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
    // provided by Parallel Software
    //$username = 'parallel';
    //$password = 'parallel';
    // create SOAP Client
    $client = new SoapClient($wsdl);
    // Authenticate with username and password
    $session_id = $client->login($username, $password);
    $_SESSION['client'] = $client;
    $_SESSION['client_id'] = $session_id;
    //return $returnArr;
}


function create_filter($field,$value,$operator){
    $php_filter = array(
        array('field' => $field, 'value' => $value, 'operator' => $operator)
        );
    return $php_filter;
}

function getAdvertByRegion($region_f){
    // Retrieve list of regions
    $regions_response = $_SESSION['client']->getAdvertRegions($_SESSION['client_id']);
    // Create an array representing the key-value pairs
    $regions = array();
    foreach($regions_response as $region)
    {
    $regions[$region->id] = $region->label;
    }
    // Create a regional filter
    $regional_filter = create_filter('region',array_search($region_f, $regions),'=' );

    // $regional_filter = array(
    //     $region_f => array(
    // 'field' => 'region',
    // 'operator' => '=',
    // 'value' => array_search($region_f, $regions)
    // )
    // );
    // retrieve vacancies
    $vacancies_in = array();
    $vacancies_in[$region_f] = $_SESSION['client']->getAdverts(
        $_SESSION['client_id'],
        array($regional_filter[$region_f])
    );
    return $vacancies_in;
}

function getAdvert_f($field= 'job_description',$value = '',$operator = '='){
    $php_filter = create_filter($field,$value,$operator);
    $vacancies = $_SESSION['client']->getAdverts($_SESSION['client_id'], $php_filter);
    return $vacancies;

}

function getUnpublised($date = '2023-02-01'){
    $adverts = $_SESSION['client']->getUnpublishedAdverts($_SESSION['client_id'], "2020-01-01 00:00:00");
    return $adverts;
}

// not done
function upload_towns_to_db(){ // to move all towns into a db 
    $regions_all = array();
    foreach($_SESSION['client'] as $obj){
        
    }
    $region=0;

    // connect to db and save all regions to it
    $conn = mysqli_connect($GLOBALS['server'],$GLOBALS['username'],$GLOBALS['PW'],$GLOBALS['db']);
    $sql = "INSERT INTO tbl_towns (`town_id`,`town_name`) VALUES (Null,'$region')";
    $query = mysqli_query($conn,$sql);
    mysqli_close($conn);

}
