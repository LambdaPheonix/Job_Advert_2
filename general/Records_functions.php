<?php
        $import = ( file_exists("../Server_details.php")) ? 
        require "../Server_details.php" : require "./Server_details.php";
        echo $import;
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

// gets company name from username
function get_company_name($uname,$connection){
    
    $sql = "SELECT `companyName` FROM tbl_users WHERE `username` = '$uname'";
    $query = mysqli_query($connection,$sql) or die(mysqli_connect_error());
    $companyname = mysqli_fetch_assoc($query);
    //mysqli_close($connection);
    return $companyname['companyName'];
}

// gets all ads linked to company name
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

// gets overall clicks of ads 
function jt_overall_clicks($jt,&$arrclicks,$conn){
    $sql = "SELECT `Clicks` FROM tbl_clicks WHERE `job_title` = '$jt'";
    $query = mysqli_query($conn,$sql) or die(mysqli_connect_error());
    $row = mysqli_fetch_assoc($query); 
    array_push($arrclicks,[$jt,$row['Clicks']]);
}

// gets daily clicks for ads in array per ad format
function jt_daily_clicks($jt,$conn){ // returns arr of arrays in form (clicks,date)
    $sql = "SELECT `daily_clicks`,`date` FROM tbl_daily_clicks WHERE `job_title` = '$jt'";
    $query = mysqli_query($conn,$sql) or die(mysqli_connect_error());
    $rows = mysqli_fetch_assoc($query);    
    $arr_daily_clicks = array();
    foreach($rows as $row){
        $arr_date_click = array();
        $date = $row['date']->format('dd-mm-yyyy');
        array_push($arr_date_click,$jt,$row['daily_clicks'], $date);
        array_push($arr_daily_clicks,$arr_date_click);

    }    
    return $arr_daily_clicks;

}

// exports all ad data for a company to 2 csv files 1 containing all the overall clicks and the next with all the dailies
function db_exportdata($uname){ 
    $conn = create_connection();
    $companyname = get_company_name($uname,$conn);
    $arr_jt = company_ads_arr($companyname,$conn);
    $jt_overall_clicks = array();
    $jt_daily_clicks = array();
    foreach($arr_jt as $jt){
        jt_overall_clicks($jt,$jt_overall_clicks,$conn);
        array_push($arr_daily_clicks, jt_daily_clicks($jt,$conn));
    }
    $date = new DateTime();
    $date_saved = $date->format('ddmmyyyy');

    // total clicks per jt file
    $filename = $uname . "_" . $companyname . "_" .  $date_saved . "_total_clicks.csv";
    if (!file_exists($filename)){
        $file = fopen($filename,'w');
        fputcsv($file,["job_title","total_clicks"]);
        foreach($jt_overall_clicks as $overall){
            fputcsv($file,$overall);
        }
    } else {
        echo_msg("file has be rewritten");
        $file = fopen($filename,'w');
        fputcsv($file,["job_title","total_clicks"]);
        foreach($jt_overall_clicks as $overall){
            fputcsv($file,$overall);
        }
    }
    fclose($file);

    // daily clicks file
    $filename2 = $uname . "_" . $companyname . "_" .  $date_saved . "_daily_clicks.csv";
    if (!file_exists($filename2)){
        $file = fopen($filename2,'w');
        fputcsv($file,["job_title","daily_clicks","date"]);
        foreach($jt_daily_clicks as $daily){
            foreach($daily as $row){
                fputcsv($file,$row);
            }
        }
    } else {
        echo_msg("file has be rewritten");
        $file = fopen($filename2,'w');
        fputcsv($file,["job_title","daily_clicks","date"]);
        foreach($jt_daily_clicks as $daily){
            foreach($daily as $row){
                fputcsv($file,$row);
            }
        }
    }
    fclose($file);   

    mysqli_close($conn);

    // structure of saved file
        // file name username_companyname_date_total_clicks.csv and username_companyname_date_daily_clicks.csv
        // username_companyname_date_total_clicks.csv has all job titles and the amount of clicks
        // username_companyname_date_daily_clicks.csv has format of jt,clicks,date with the same job title listed to continuiously

}