<?php
// imports required files to use
require "../Server_details.php";

// imports data to manipulate from server
$data = json_decode(file_get_contents("php://input"), true);

// functions to make the upload of ad daily clicks happen
// functions for unseen ads
function check_records($job_title,$uname)
{
    $con = create_connection();
    $sql_check = "SELECT `job_title` FROM tbl_clicks where `job_title` = '$job_title'";
    $query = mysqli_query($con,$sql_check) or die('Connection error: '. mysqli_connect_error());
    if (mysqli_num_rows($query)<1)
    {
        mysqli_close($con);
        // insert job_title in to tbl clicks
        $sql_insert = "INSERT INTO tbl_clicks (`job_title`,`Clicks`) VALUES ('$job_title','0');";
        $con_insert = create_connection();
        mysqli_query($con_insert,$sql_insert);
        mysqli_close($con_insert);
        // insert job_title into tbl_company_ad_relation
        $company_name = get_company_name_2($uname);
        $sql_insert = "INSERT INTO tbl_company_ad_relation (`Company_name`,`job_title`) VALUES ('$company_name','$job_title');";
        $con_ad_relation = create_connection();
        mysqli_query($con_ad_relation,$sql_insert);
        return "<sript>console.log('new ad inserted into db');</script>";

    }else {
        return;
    }

}

function get_company_name_2($uname)
{
    $connection = create_connection();
    $sql = "SELECT `companyName` FROM tbl_users WHERE `username` = '$uname'";
    $query = mysqli_query($connection,$sql) or die(mysqli_connect_error());
    $companyname = mysqli_fetch_assoc($query);
    $r_str = $companyname['companyName'];
    mysqli_close($connection);
    return $r_str;
}

function update_records_tbl()
{ // this function creates and executes and update sql that take the sum of all dailies to make the overall
    $sql= "UPDATE `tbl_clicks` SET `Clicks`=(SELECT sum(`daily_clicks`) FROM tbl_daily_clicks WHERE tbl_clicks.job_title = tbl_daily_clicks.job_title);";
    $con = create_connection();
    mysqli_query($con,$sql);
    mysqli_close($con);
}

function upload_insta($job_title,$date,$uname = 'parallel')
{ // functions uploads the daily clicks to the db 
    // if job_title does not exist in db create it.
    check_records($job_title,$uname);

    // checks if daily record has been made
    $con = create_connection();
    $sql = "SELECT * FROM tbl_daily_clicks where `date` = '$date' and `job_title` = '$job_title'";
    $query = mysqli_query($con,$sql) or die('connection error: ' .mysqli_connect_error() );
    if(mysqli_num_rows($query)>0 && mysqli_num_rows($query)<2)
    { // if only one record for the day update it
        mysqli_close($con);
        return update_entry($job_title,1,$date);

    } elseif (mysqli_num_rows($query)>1)
    { // if more than 1 record for the daily it makes it one record and plus 1
        $clicks = 0;
        while($row = mysqli_fetch_assoc($query))
        { // counts clicks for same date
            $click = (int)$row['daily_clicks'];
            $clicks += $click;
        }
        mysqli_close($con);

        // deletes all records for the after summing their values
        $con = create_connection();
        $sql = "DELETE FROM tbl_daily_clicks WHERE `job_title` = '$job_title'";
        mysqli_close($con);

        // makes new daily record after the duplicates have been deleted
        return insert_entry($job_title,$clicks+1,$date); 
    } else { // make new record if there isn't one for the day
        mysqli_close($con);
        return insert_entry($job_title,1,$date);
    }
}

function create_insert_sql($job_title,$clicks,$date)
{ // creates insert SQL for tbl_daily_clicks 
    $sql = "INSERT INTO tbl_daily_clicks (`job_title`, `daily_clicks`, `date`) VALUES ('$job_title','$clicks','$date')";
    return $sql;
}

function create_update_sql($job_title,$clicks,$date)
{ // note only works for tbl_daily_clicks
    return " UPDATE tbl_daily_clicks SET `daily_clicks` = `daily_clicks`+'$clicks' WHERE `job_title` = '$job_title' AND `date`='$date'; ";
}


function insert_entry($job_title,$clicks,$date)
{ // creates new daily record in db and updates overall record  
    $con = create_connection();
    $sql = create_insert_sql($job_title,$clicks,$date);
    mysqli_query($con,$sql) or die("update query failed:". mysqli_connect_error());
    mysqli_close($con);
    update_records_tbl();
    return "New Entry Success";
}

function update_entry($job_title,$clicks,$date)
{ // updates daily record and overall record
    $con = create_connection();
    $sql = create_update_sql($job_title,$clicks,$date);
    mysqli_query($con,$sql) or die("update query failed:". mysqli_connect_error());
    mysqli_close($con);
    update_records_tbl();
    return "Update Success!";
}

// return data in format to use (in this case uploads to db)
echo "(".json_encode($data).")";

echo upload_insta($data[0],$data[1],$data[2]);
