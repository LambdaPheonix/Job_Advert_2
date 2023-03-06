
<?php
require '../Session.php';
// when logged in this displays the data of the ads clicks, 
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Path_maker</title>
    <style>
        <?php 
            require '../Styles/site.css';
         ?>
        form{
            margin: 10px;
            padding: 15px;
        }
    </style>

    </head>
    <body>
        <div id="heading" class="bg_wide">
            <h2>Please select what data to export to CSV</h2>
        </div>
        <div id="btns" class="bg_wide">

        <form method="POST">
                <input type="submit" id="daily" name="daily" value="Export daily Data">
            </form> 
            <form method="POST">
                <input type="submit" id="overall" name="overall" value="Export overall Data">
            </form>
            <form method="POST">
                <input type="submit" id="data" name="data" value="Export Data">
            </form>
        </div>
    <script></script>
    <?php 
        // if btns clicked
        if (isset($_POST['data'])){
            get_dailys_CSV();
            get_overall_CSV();
            unset($_POST['data']);
        }elseif(isset($_POST['overall'])){
            get_overall_CSV();
            unset($_POST['overall']);
        }elseif(isset($_POST['daily'])){
            get_dailys_CSV();
            unset($_POST['daily']);
        }

        // export data to CSV
        function get_dailys_CSV(){ // export dailies on their own all jts
            $companyname = get_company_name_3();
            // create array of job_titles that make can be used to get clicks
            $con = create_connection();
            $sql = "SELECT `job_title` FROM tbl_company_ad_relation where `Company_name` = '$companyname'";
            $query = mysqli_query($con,$sql) or die("connection error:". mysqli_connect_error());
            if(mysqli_num_rows($query)>0){
                $arrJT = array();
                $rows = mysqli_fetch_assoc($query);
                foreach($rows as $row){
                    array_push($arrJT,$row);
                }

            }else{
                return echo_msg("No Ads for this user names company");
            }
            mysqli_close($con);

            // creating the array to export daily clicks
            $arr_daily= array();
            foreach($arrJT as $jt){
                $arr_dailys = array();
                $arr_dailys= get_daily_clicks($jt);
                foreach($arr_dailys as $days){
                    array_push($arr_daily,$days);
                }
            }
            // export to CSV
            $date = date("jS_F_Y");
            $filename = $companyname."_".$date."_daily.csv";
            if (file_exists($filename)){
                $file = fopen($filename, 'w');
                foreach($arr_daily as $arr){
                    fputcsv($file,$arr);
                }
                echo_msg("file has been over written");
                fclose($file);
            }else{
                $file = fopen($filename, 'w');
                foreach($arr_daily as $arr){
                    fputcsv($file,$arr);
                }
                echo_msg("new file has been created");
                fclose($file);
            }
        }

        // finds company name from username
        function get_company_name_3(){
            $uname = $_SESSION['uname'];
            $connection = create_connection();
            $sql = "SELECT `companyName` FROM tbl_users WHERE `username` = '$uname'";
            $query = mysqli_query($connection,$sql) or die(mysqli_connect_error());
            $companyname = mysqli_fetch_assoc($query);
            $r_str = $companyname['companyName'];
            mysqli_close($connection);
            //echo_msg($r_str. " is the company name");
            return $r_str;
        }

        function get_daily_clicks($jt){ // returns the following  ass arry arr = [clicks','date']
            $con = create_connection();
            $arr_JT_daily = array();
            $sql = "SELECT `daily_clicks`,`date` from tbl_daily_clicks where `job_title` = '$jt';";
            $query = mysqli_query($con,$sql) or die("connection error:". mysqli_connect_error());
            if (mysqli_num_rows($query)>0){
                $rows = mysqli_fetch_assoc($query);
                for($i=0;$i<mysqli_num_rows($query);$i++){
                    echo "<sript>console.log('".json_encode($rows)."');</script>";
                    $arr = array();
                    $arr = [$jt,$rows['daily_clicks'],$rows['date']];
                    array_push($arr_JT_daily,$arr);
                }
                return $arr_JT_daily;
            }else{
                return array_push($arr_JT_daily,[$jt,'No_records','0000-00-00']);
            }
        }

        function get_overall_clicks($jt){ // returns the overall clicks in array form
            $con = create_connection();
            $arr_JT_overall = array();
            $sql = "SELECT `Clicks` from tbl_clicks where `job_title` = '$jt';";
            $query = mysqli_query($con,$sql) or die("connection error:". mysqli_connect_error());
            if (mysqli_num_rows($query)>0){
                $row = mysqli_fetch_assoc($query);
                $arr_JT_overall = [$jt,$row['Clicks']];
                return $arr_JT_overall;
            }else{
                return $arr_JT_overall = [$jt,'0'];
            }
        }

        // to export all the overall ad data
        function get_overall_CSV(){ // export dailies on their own all jts
            $companyname = get_company_name_3();
            // create array of job_titles that make can be used to get clicks
            $con = create_connection();
            $sql = "SELECT `job_title` FROM tbl_company_ad_relation where `Company_name` = '$companyname'";
            $query = mysqli_query($con,$sql) or die("connection error:". mysqli_connect_error());
            if(mysqli_num_rows($query)>0){
                $arrJT = array();
                $rows = mysqli_fetch_assoc($query);
                foreach($rows as $row){
                    array_push($arrJT,$row);
                }

            }else{
                return echo_msg("No Ads for this user names company");
            }
            mysqli_close($con);

            // creating the array to export daily clicks
            $arr_overalls= array();
            foreach($arrJT as $jt){
                $arr_overall = array();
                $arr_overall= get_overall_clicks($jt);
                array_push($arr_overalls,$arr_overall);

            }
            // export to CSV
            $date = date("jS_F_Y");
            $filename = $companyname."_".$date."_overall.csv";
            if (file_exists($filename)){
                $file = fopen($filename, 'w');
                foreach($arr_overalls as $arr){
                    fputcsv($file,$arr);
                }
                echo_msg("file has been over written");
                fclose($file);
            }else{
                $file = fopen($filename, 'w');
                foreach($arr_overalls as $arr){
                    fputcsv($file,$arr);
                }
                echo_msg("new file has been created");
                fclose($file);
            }
        }

    ?>
    </body>



