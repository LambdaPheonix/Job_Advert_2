<?php
require "../Session.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test filters</title>
        <style>
            <?php 
                //require '../Styles/site.css';
                require '../Styles/Grid_ad.css';
            ?>
    </style>
    </head>
    <body>
        <h1>to test filters</h1>
        <form action="filter_return" id="filter_c" method="post">
            <label for="region">enter region:</label><br>
            <input  id="region" type="text" name="region"> <br><br>
            <input type="hidden" name="returnFilter" value="1">
            <input type="submit" name="submit">
        </form>
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
            echo "<div class='ads' id='ads_display'>$output</div>";
        ?>
    </body>