<?php
require '../Session.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Path_maker</title>
    <style>
        <?php 
            require '../Styles/site.css';
            require '../Styles/Grid_ad.css';
         ?>
    </style>

    </head>
    <body>
        <div class="back_box" id="display_ad_box">

            <!-- func_btns -->
            <div class="bg_wide" id="func_btns">
                <div class="bg" id="func_btns_heading">
                    <h2>Filters for ads:</h2>
                </div>
                <div class="bg_wide" id="func_btns_div">
                    <button id="filter" class="func_btn" >Filter</button>
                    <button id="region filter" class="func_btn" >Region Filter</button>
                    <button id="unpub_ad" class="func_btn Login invis" >Unpublised Adverts</button>
                </div>
               
            </div> 
            <div class="bg_wide" id="filters_bg" >
                <div class="bg_wide filter_div" id="filter_div" >
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="filter_form" class="filter_forms">
                            <label for="field_in">Select a Field</label>
                            <select id="field_in" name="field_in">
                                <option>Job Title</option>
                                <option>Region</option>
                                <option>Town</option>
                                <option>Sector</option>
                            </select> 

                            <label for="value_in">description for the field:</label>
                            <input type="text" id="Value_in" name="value_in">
                            
                            <label for="operator_in">Select an Operator</label>
                            <select id="operator_in" name="operator_in">
                                <option>equal to</option>
                                <option>not equal</option>
                                <option>contains</option>
                            </select>

                            <input type="submit" name="submit_filter">
                        </form> <!-- filter_form -->
                    </div> <!-- filter_div -->

                    <div class="bg_wide filter_div" id="region_div" >
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="region_form" class="filter_forms">
                            <label for="region_in">Select a Field</label>
                            <select id="region_in" name="region_in">
                                <option>Gauteng</option>
                                <option>Western Cape</option>
                                <option>Eastern Cape</option>
                                <option>Northern Cape</option>
                                <option>North West</option>
                                <option>Free State</option>
                                <option>Mpumalanga</option>
                                <option>Limpopo</option>
                                <option>KwaZulu Natal</option>
                            </select> 

                            <input type="submit" name="submit_region">
                        </form> <!-- region_form -->
                    </div> <!-- region_div -->

                    <div class="bg_wide filter_div" id="unpub_div" >
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="unpub_form" class="filter_forms">
                            <label for="unpub_in">Select a Field</label>
                            <input type="date" id="unpub_in" name="unpub_in">

                            <input type="submit" name="submit_unpub">
                    </form> <!-- unpub_form -->
                </div> <!-- unpub_div --> 
            </div>
            <div class="bg_wide">
                <h1>Job Adverts availible</h1>
            </div>   
            
            <?php
                //echo json_encode( $_SESSION['client']). "<br>". json_encode($_SESSION['client_id']);
                $ad_JT = array();
                if (isset($_POST['submit_filter'])){
                    $ad_JT=submit_filter_form();
                    
                } elseif (isset($_POST['submit_region'])){
                    $ad_JT = submit_region_form();
                } elseif (isset($_POST['submit_unpub'])){
                    $ad_JT = submit_unpub_form();
                }
                //$ad_JT = DisplayFilter_start();
                 ?>
        </div> <!-- display_ad_box -->
        <script type="module" src = "Job_view_script.js"  > </script>
        <script type="module">
            // imported functions
            import { hideMDDiv, DisplayMoreDetails, DisplayMDAd, addOnClick_MDbtn, cleanAdsDisplayDiv, displayFilter, displayRegion, displayUnpub, addClickFuncBtns } from  "./Job_view_script.js";
            import { sendData, todayDate } from "./Record_clicks.js";
            // funcs to func_btns
            addClickFuncBtns();
            // DOM assistance
           
            
            var arrJTstr = "<?php $combinestr = '';foreach($ad_JT as $JT){ add_str("$JT,",$combinestr);} echo $combinestr;?>";
            arrJTstr = arrJTstr.substr(0,arrJTstr.length-1);
            var arrJT = arrJTstr.split(",");
            var $uname = "<?php $uname = (!isset($_POST['uname']))?'parallel':$_POST['uname'];echo $uname ?>";
            hideMDDiv(); // hides more dtails
            // adds onclick to more detail buttons
            var btns = document.querySelectorAll(".MD_btn");
            for (let i = 0; i < arrJT.length; i++) {
                const element = arrJT[i];
                const btn = btns[i];      
                addOnClick_MDbtn(btn,element,$uname);
            }

        </script>
    
            <div id="dump"></div>
<?php

    if(isset($_SESSION['Logged'])){
        if ($_SESSION['Logged'] == 1){
           echo "<script> document.querySelector('.Login').classList.remove('invis'); </script>";

        } else {
            echo "<script> document.querySelector('.Login').classList.add('invis'); </script>";
        }
    }else{
        echo "<script> document.querySelector('.Login').classList.add('invis'); </script>";

    }
    // clean up the filter data
    // change the select data to usable data
    // use the filter data to make job ad clickables
    // count the clicks on the ad

    // standard load in to screan
    //$adverts = getAdvert_f();
    
    // set vars for filters
    
        //getAdvert_f($field_in,$value_in,$operator_in);

        // region data

        // unpub data

        //if 
    



?>

</body>
