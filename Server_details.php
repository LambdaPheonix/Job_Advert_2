<?php   
// server details
echo $server = "localhost";
echo $user = "root";
echo $PW = '';
echo $db = "job_adverts";

function create_connection(){ // creates connection to server
    $con = mysqli_connect($GLOBALS['server'],$GLOBALS['user'],$GLOBALS['PW'],$GLOBALS['db']) or die('failed to connect: '. mysqli_connect_error());
    return $con;
}