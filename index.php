<?php 
    require "general/Session.php"; 
    require "Styles/Login_swap.php";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    
    <div id="nav_bar">
        <?php require ("HTML_parts\Nav_bar_html_outside.php")?>
    </div>
</body>

<?php

// sets default vars to be used


foreach(array_keys($_SESSION) as $key){
    echo $key.','.$_SESSION[$key];
}
