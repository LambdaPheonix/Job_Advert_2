<?php
    require "../Server_details.php";
// holds the functions to make the data saveable and displayable
// 

function dump_session_csv($arr){
    if (!file_exists("Array_test.csv")){
        $fcsv = fopen("Array_test.csv", 'w');

        //foreach($arr as $elem){
            fputcsv($fcsv,$arr);
        //}
        fclose($fcsv);
    } else {
        $fcsv = fopen("Array_test.csv", 'a'); 
        //foreach($arr as $elem){
            fputcsv($fcsv,$arr);
        //}
        fclose($fcsv);
    }
}


function get_company_name($uname,$connection){
    
    $sql = "SELECT `companyName` FROM tbl_users WHERE `username` = '$uname'";
    $query = mysqli_query($connection,$sql) or die(mysqli_connect_error());
    $companyname = mysqli_fetch_assoc($query);
    //mysqli_close($connection);
    return $companyname['companyName'];
}

function company_ads_arr($companyname,$conn){
    $sql = "SELECT `job_titles` FROM tbl_company_ad_relation WHERE `Company_name` = '$companyname'";
    $query = mysqli_query($conn,$sql) or die(mysqli_connect_error());
    $jt_arr = array();
    $rows = mysqli_fetch_assoc($query); 
    foreach($rows as $row) {
        array_push($jt_arr,$row['job_titles']);
    }
    return $jt_arr;
}

function jt_overall_clicks($jt,&$arrclicks,$conn){
    $sql = "SELECT `Clicks` FROM tbl_clicks WHERE `job_title` = '$jt'";
    $query = mysqli_query($conn,$sql) or die(mysqli_connect_error());
    $row = mysqli_fetch_assoc($query); 
    array_push($arrclicks,$row['Clicks']);
}

function jt_daily_clicks($jt,$conn){ // returns arr of arrays in form (clicks,date)
    $sql = "SELECT `daily_clicks`,`date` FROM tbl_daily_clicks WHERE `job_title` = '$jt'";
    $query = mysqli_query($conn,$sql) or die(mysqli_connect_error());
    $rows = mysqli_fetch_assoc($query);    
    $arr_daily_clicks = array();
    foreach($rows as $row){
        $arr_date_click = array();
        $date = $row['date']->format('dd-mm-yyyy');
        array_push($arr_date_click,$row['daily_clicks'], $date);
        array_push($arr_daily_clicks,$arr_date_click);

    }    
    return $arr_daily_clicks;

}



function db_exportdata($uname){ // saves all company data to a csv for all ad data available
    $conn = mysqli_connect($GLOBALS['server'],$GLOBALS['user'],$GLOBALS['PW'],$GLOBALS['db']) or die(mysqli_connect_error());
    $companyname = get_company_name($uname,$conn);
    $arr_jt = company_ads_arr($companyname,$conn);
    $jt_overall_clicks = array();
    $jt_daily_clicks = array();
    foreach($arr_jt as $jt){
        jt_overall_clicks($jt,$jt_overall_clicks,$conn);
        array_push($arr_daily_clicks, jt_daily_clicks($jt,$conn));
    }
    


    mysqli_close($conn);
}