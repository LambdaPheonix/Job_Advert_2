<?php
require 'Jobs_displayed_processing.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Path_maker</title>
    <style>
        <?php require '../Styles/site.css' ?>
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
                    <button id="filter" class="func_btn" onclick="displayFilter()">Filter</button>
                    <button id="region filter" class="func_btn" onclick="displayRegion()">Region Filter</button>
                    <button id="unpub_ad" class="func_btn" onclick="displayUnpub()">Unpublised Adverts</button>
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

                            <input type="submit" name="submit">
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

                            <input type="submit" name="submit">
                        </form> <!-- region_form -->
                    </div> <!-- region_div -->

                    <div class="bg_wide filter_div" id="unpub_div" >
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="unpub_form" class="filter_forms">
                            <label for="unpub_in">Select a Field</label>
                            <input type="date" id="unpub_in" name="unpub_in">

                            <input type="submit" name="submit">
                    </form> <!-- unpub_form -->
                </div> <!-- unpub_div --> 
            </div>
            <div class="bg_wide">
                <h1>Job Adverts availible</h1>
            </div>   
            
            <?php
                //echo json_encode( $_SESSION['client']). "<br>". json_encode($_SESSION['client_id']);
                $adverts = getAdvert_f();
                $ad_elem = array();
                $output ='';
                foreach($adverts as $ad){ 
                ad_div_creation($ad,$ad_elem);
                }
                foreach($ad_elem as $elem){
                    add_str($elem,$output);
                }
                echo "<div class='bg_wide ads' id='ads_display'>$output</div>";
                 ?>
        </div> <!-- display_ad_box -->
        <script src="Job_view_script.js"></script>
    </body>

<?php
    // clean up the filter data
    // change the select data to usable data
    // use the filter data to make job ad clickables
    // count the clicks on the ad

    // standard load in to screan
    //$adverts = getAdvert_f();
    
    // set vars for filters
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // filter data
        $field_in = $value_in = $operator_in = '';
        //if()
        $field_in = sanitizeInput($_POST['field_in']);
        $value_in = sanitizeInput($_POST['value_in']);
        $operator_in = sanitizeInput($_POST['operator_in']);
        // region data
        $region = '';
        $region = sanitizeInput($_POST['region_in']);
        // unpub data
        $date_in = '';
        $date_in = sanitizeInput($_POST['unpub_in']);
        //if 
    }



?>
