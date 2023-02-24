<?php


require "..\HTML_parts\Nav_bar_html_inside.php";
require "General_functions.php";
//require "Session.php";

//$regions =  $_SESSION['client']->getAdvertRegions($_SESSION['client_id']);
//var_dump($regions);

// Retrieve list of regions
// makes a function that can filter regions by $region_f
function upload_regions_to_db(){
    $regions_all = array();
    foreach($_SESSION['client'] as $obj){
        
    }
    $region=0;

    // connect to db and save all regions to it
    $conn = mysqli_connect($GLOBALS['server'],$GLOBALS['username'],$GLOBALS['PW'],$GLOBALS['db']);
    $sql = "INSERT INTO tbl_regions (`Region_id`,`Region_name`) VALUES (Null,'$region')";
    $query = mysqli_query($conn,$sql);

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
    $regional_filter = array(
        $region_f => array(
    'field' => 'region',
    'operator' => '=',
    'value' => array_search($region_f, $regions)
    )
    );
    // retrieve vacancies
    $vacancies_in = array();
    $vacancies_in[$region_f] = $_SESSION['client']->getAdverts(
        $_SESSION['client_id'],
        array($regional_filter[$region_f])
    );
    return $vacancies_in;
}

$vacancies_in = getAdvertByRegion("Gauteng");
// dump the results
// var_dump($vacancies_in);



foreach($vacancies_in as $elem){
    $dump = json_encode($elem);
    echo "<br>"."<br>".$dump;
}