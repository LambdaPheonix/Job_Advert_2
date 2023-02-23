<?php
    // includes server details for mySQL functions
    require "..\Server_details.php";
    require "ad_filter.php";
    require "Session.php";
    // global vars to use in general functions

    // checks the username and password returns boolean
    function check_username_password($uname,$psw,$tbl,&$msg){
        $conn =  mysqli_connect($GLOBALS['server'],$GLOBALS['user'],$GLOBALS['PW'],$GLOBALS['db']) or die("could not connect to db". mysqli_connect_error());
        $sql = "SELECT name, password FROM $tbl WHERE name = '$uname' ";
        if ($query =  mysqli_query($conn,$sql)) {
            if (mysqli_num_rows($query)>0){    
                $row = mysqli_fetch_assoc($query);
                if ($uname == $row['name']  && $psw == $row['password']){
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

    function get_user_id($uname,$tbl){
        $conn = mysqli_connect($GLOBALS['server'],$GLOBALS['user'],$GLOBALS['PW'],$GLOBALS['db']) or die("could not connect to db". mysqli_connect_error());
        $sql = "SELECT `name`,`user_id` FROM $tbl WHERE `name` = '$uname' ";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_row($query);
        $user_id = $row['user_id'];
        mysqli_close($conn);
        return $user_id;
    }

    function echo_msg($msg){
        echo "<script>alert('$msg');
        </script>";
    }

    function sanitizeInput($beforeSanitize){ // cleans input from any  unwanted chars or XSS
        $beforeSanitize = trim($beforeSanitize);
        $beforeSanitize = stripslashes($beforeSanitize);
        $beforeSanitize = htmlspecialchars($beforeSanitize);
        return $beforeSanitize;  
            
       
    }

?>