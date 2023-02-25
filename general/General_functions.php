<?php
    // includes server details for mySQL functions
    require "../Server_details.php";
    //require "Session.php";
    require "API_functions.php";
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

    function SwapLogin($num){

        $login = "\Job_advert_2\Login\Login_form.php";
        $job_ad = "\Job_advert_2\Job_ad_manipulation\Jobs_display_view.php";
        $data_ad = "\Job_advert_2\Job_ad_manipulation\Jobs_data.php";
        $logout = "\Job_advert_2\Login\LogOut.php";
        $arrPaths_logged = array("Job_Adverts" => $job_ad, "Advert_Data" => $data_ad, "Logout" => $logout);
        $arrPaths_not_logged = array("Job_adverts" => $job_ad, "Login" => $login); 
         
        
            if ($num == 1) {
                $arrkeys = array_keys($arrPaths_logged);
                $combineStr = '';
                for ($i=0; $i < count($arrkeys); $i++) { 
                    $key = $arrkeys[$i];
                    $elem = $arrPaths_logged[$key];
                    //echo WrapTag($key.':'.$elem,'h1');
                    $aTag = aTag_href($elem,$key,'li');
                    add_str($aTag,$combineStr);
                    
                }
                $ul = WrapTag($combineStr,'ul');
                $nav = WrapTag($ul,'nav');
                $div = WrapTag($nav,'div');
                echo $div;
                }
        
            if ($num == 0) {
                $arrkeys = array_keys($arrPaths_not_logged);
                $combineStr = '';
                for ($i=0; $i < count($arrkeys); $i++) { 
                    $key = $arrkeys[$i];
                    $elem = $arrPaths_not_logged[$key];
                    //echo WrapTag($key.':'.$elem,'h1');
                    $aTag = aTag_href($elem,$key,'li');
                    add_str($aTag,$combineStr);
                    
                }
                $ul = WrapTag($combineStr,'ul');
                $nav = WrapTag($ul,'nav');
                $div = WrapTag($nav,'div');
                echo $div;
                }
        
            //echo '<br>' . WrapTag($_SESSION['Logged'],'h1');
            }

function login_catchup(){
    $_SESSION['Catch_up'] = $_SESSION['Logged']-1;
}
?>

