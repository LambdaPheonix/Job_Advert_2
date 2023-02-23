<?php
require "../general/General_functions.php";

$login = "\Job_advert_2\Login\Login_form.php";
$job_ad = "\Job_advert_2\Job_ad_manipulation\Jobs_displayed.php";
$data_ad = "\Job_advert_2\Job_ad_manipulation\Jobs_data.php";
$arrPaths_logged = array("Job_ads" => $job_ad, "data_ads" => $data_ad);
$arrPaths_not_logged = array("Job_ads" => $job_ad, "Login" => $login); 
 

    if ($_SESSION['Logged'] == 1) {
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

    if ($_SESSION['Logged'] == 0) {
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

    echo '<br>' . WrapTag($_SESSION['Logged'],'h1');

?>

