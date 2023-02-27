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
    function WrapTag($combineStr, $tag){    
        return "<$tag>$combineStr</$tag>";
    }

    function WrapTag_attr($combineStr, $tag, $attr_str = null){
        if ($attr_str == null){
            return "<$tag>$combineStr</$tag>";
        } else {
        return "<$tag $attr_str>$combineStr</$tag>";
        }
    }

    function add_attr($arr_combo){
        if ($arr_combo[0]=='' &&  $arr_combo[1]==''){
            return null;
        } else {
        return " $arr_combo[0]='$arr_combo[1]' ";
        }
    }

    function create_attr_array($attr,$des_attr,&$arr_attr){
        $arr_combo = array($attr,$des_attr);
        array_push($arr_combo,$arr_attr);
    }
 
    // string combiner
    function add_str($newStr,&$combineStr){
        if ($newStr == null){
            $combineStr = $combineStr;
        } else {
        $combineStr = $combineStr.$newStr;
        }
    }
    
    // gives a href to an 'a' tag and wraps in in any tag you wish
    function aTag_href($path,$label,$tag){
        $href = "href='$path'";
        $beforeWrap = "<a $href >$label</a>";
        return WrapTag($beforeWrap,$tag);
    }

    function ad_div_creation($std_obj_ad,&$arr_elems){
        $job_title = sanitizeInput($std_obj_ad->job_title);
        $brief_description = sanitizeInput($std_obj_ad->brief_description);
        $detail_description = sanitizeInput($std_obj_ad->detail_description);
        $region = sanitizeInput($std_obj_ad->region);
        $contact = sanitizeInput($std_obj_ad->consultant_name);
        $email = sanitizeInput($std_obj_ad->response_email);
        $combineStr = "";
        add_str(WrapTag_attr(WrapTag("Job Title: $job_title",'p'),'div',add_attr(array('class','JT'))),$combineStr);       
        add_str(WrapTag_attr(WrapTag($brief_description,'p'),'div',add_attr(array('class',"brief"))),$combineStr);
        add_str(WrapTag_attr(WrapTag_attr("More details",'button',add_attr(array('class',"MD_btn ". $job_title."_btn"))),'div',add_attr(array('class','btn'))),$combineStr);
        add_str(WrapTag_attr(WrapTag($detail_description,'p'),'div',add_attr(array('class',"detail  $job_title MD_div"))),$combineStr);
        add_str(WrapTag_attr(WrapTag("Region: $region",'p'),'div',add_attr(array('class',"region $job_title MD_div"))),$combineStr);
        add_str(WrapTag_attr(WrapTag("Consultant name: $contact",'p'),'div',add_attr(array('class',"contact $job_title MD_div"))),$combineStr);
        add_str(WrapTag_attr(WrapTag("Response email: $email",'p'),'div',add_attr(array('class',"email $job_title MD_div"))),$combineStr);
        //add_str("<br>",$combineStr);
        $combineStr = WrapTag_attr($combineStr,'section',add_attr(array('class','ad_container')));
        array_push($arr_elems,$combineStr);

    }

    function SwapLogin($num){

        $login = "\Job_advert_2\Login\Login_form.php";
        $job_ad = "\Job_advert_2\Job_ad_manipulation\Jobs_display_view.php";
        $data_ad = "\Job_advert_2\Job_ad_manipulation\Jobs_view_data.php";
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

function check_key_session($key){
    if (array_key_exists($key , $_SESSION) || !isset($_SESSION[$key])){
        return false;
    } else {
        return true;
    }
}

function DisplayFilter_start($field= 'job_description',$value = '',$op = '='){
    echo "<script type='module'> import { cleanAdsDisplayDiv } from './Job_view_script.js'; cleanAdsDisplayDiv(); </script>";
    $adverts = getAdvert_f($field,$value,$op);
    $ad_elem = array();
    $ad_JT = array();
    $output ='';
    foreach($adverts as $ad){ 
        array_push($ad_JT,$ad->job_title);
        ad_div_creation($ad,$ad_elem);
    }
    foreach($ad_elem as $elem){
        add_str($elem,$output);    
    }
    echo "<div class='ads' id='ads_display'>$output</div>";
    return $ad_JT;
}

function submit_filter_form(){
    $ad_JT = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // filter data
        $field_in = $value_in = $operator_in = '';

        $field_in = sanitizeInput($_POST['field_in']);
        $value_in = sanitizeInput($_POST['value_in']);
        $operator_in = sanitizeInput($_POST['operator_in']);
        // changes operator_in to the right format
        switch ($operator_in) { 
            case 'equal to':
                $operator_in = '=';
                break;
            
            case 'not equal':
                $operator_in = '!=';
                break;
            
            case 'contains':
                $operator_in = '~';
                break;
        }
        $ad_JT = DisplayFilter_start($field_in,$value_in,$operator_in);
        unset($_POST['submit_filter']);
        return $ad_JT;
    }

    
}

function DisplayRegion($region = 'Gauteng'){
    echo "<script type='module'> import { cleanAdsDisplayDiv } from './Job_view_script.js'; cleanAdsDisplayDiv(); </script>";
    $adverts = getAdvertByRegion($region);
    $ad_elem = array();
    $ad_JT = array();
    $output ='';
    foreach($adverts as $ad){ 
        array_push($ad_JT,$ad->job_title);
        ad_div_creation($ad,$ad_elem);
    }
    foreach($ad_elem as $elem){
        add_str($elem,$output);    
    }
    echo "<div class='ads' id='ads_display'>$output</div>";
    return $ad_JT;
}

function submit_region_form(){ // populates the region filter and returns the values from the API
    $ad_JT = array();
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // region data
        $region = '';
        $region = sanitizeInput($_POST['region_in']);
        $ad_JT = DisplayRegion($region);
        // unset to use again
        unset($_POST['submit_region']);
        // returns array of job titles to use a ref for the divs.
        return $ad_JT;
    }

}

?>

