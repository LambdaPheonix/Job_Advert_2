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
            <header class="bg">
                <h1>Job Adverts availible</h1>
            </header>
            <div class="bg" id="func_btns">
                <div class="bg" >
                    <button id="filter">Filter</button>
                    <button id="region filter">Region Filter</button>
                    <button id="unpub_ad">Unpublised Adverts</button>
                </div>
                <div class="bg" id="filter_div" style="display:none">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="filter_form">
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

                <div class="bg" id="region_div" style="display:none">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="region_form">
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

                <div class="bg" id="unpub_div" style="display:none">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" id="unpub_form">
                        <label for="unpub_in">Select a Field</label>
                        <input type="date" id="unpub_in" name="unpub_in">


                        <input type="submit" name="submit">
                    </form> <!-- region_form -->
                </div> <!-- region_div -->                
            </div> <!-- func_btns -->
        </div> <!-- display_ad_box -->
    </body>
