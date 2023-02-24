<?php
    // includes server details for mySQL functions
    require "../Server_details.php";
    require "Session.php";
    // global vars to use in general functions

    // checks the username and password returns boolean
    function check_username_password($uname,$psw,$tbl,&$msg){
        // connects to db
        $conn =  mysqli_connect($GLOBALS['server'],$GLOBALS['user'],$GLOBALS['PW'],$GLOBALS['db']) or die("could not connect to db". mysqli_connect_error());
        // sql to get password from username
        $sql = "SELECT username, password FROM $tbl WHERE username = '$uname' ";
        // check if password matches
        if ($query =  mysqli_query($conn,$sql)) {
            if (mysqli_num_rows($query)>0){    
                $row = mysqli_fetch_assoc($query);
                if ($uname == $row['username']  && $psw == $row['password']){
                    $msg = "login Success";
                    return true;     
                } else {
                    $msg ="login has failed. Password or username is incorrect";
                    return false;    
                }
            } else {
                $msg ="username does not exist";
                return false;
            }
        } else {
            $msg = "Something when wrong in the db please contact support";
            die();
            return false;
        }
        mysqli_close($conn);
    }

    function echo_msg($msg){ // creates and alert out of a message
        echo "<script>alert('$msg');
        </script>";
    }

    function sanitizeInput($beforeSanitize){ // cleans input from any  unwanted chars or XSS
        $beforeSanitize = trim($beforeSanitize);
        $beforeSanitize = stripslashes($beforeSanitize);
        $beforeSanitize = htmlspecialchars($beforeSanitize);
        return $beforeSanitize;      
    }

    function display_array($arr){
        foreach($arr as $elem){
            echo "<br>".$elem;
        }
    }

    function createSoapClient_1(){ // connects to SOAP API and returns a client.
        // define WSDL location
        $wsdl = "https://webapp.placementpartner.com/ws/clients/?wsdl";
        // provided by Parallel Software
        $username = 'parallel';
        $password = 'parallel';
        // create SOAP Client
        $client = new SoapClient($wsdl);
        // Authenticate with username and password
        $session_id = $client->login($username, $password);
        $_SESSION['client'] = $client;
        $_SESSION['client_id'] = $session_id;
        //return $returnArr;
    }

    // wraps text in a tag
    function WrapTag($combineStr,$tag){
        return "<$tag>$combineStr</$tag>";
    }

    function named_tag($name,$tag){

    }
    
    // string combiner
    function add_str($newStr,&$combineStr){
        $combineStr = $combineStr.$newStr;
    }
    
    // gives a href to an 'a' tag and wraps in in any tag you wish
    function aTag_href($path,$label,$tag){
        $href = "href='$path'";
        $beforeWrap = "<a $href >$label</a>";
        return WrapTag($beforeWrap,$tag);
    }

    function ad_div_creation($std_obj_ad){
        $job_title = sanitizeInput($std_obj_ad->job_title);
        $brief_description = sanitizeInput($std_obj_ad->brief_description);
        $detail_description = sanitizeInput($std_obj_ad->detail_description);
        $region = sanitizeInput($std_obj_ad->region);
        $combineStr = "";
        add_str(WrapTag(WrapTag($job_title,'p'),'div'),$combineStr);       
        add_str(WrapTag(WrapTag($brief_description,'p'),'div'),$combineStr);
        add_str(WrapTag(WrapTag($detail_description,'p'),'div'),$combineStr);
        add_str(WrapTag(WrapTag($region,'p'),'div'),$combineStr);
        add_str("<br>",$combineStr);
        echo WrapTag($combineStr,'div')."<br>";
    }
?>