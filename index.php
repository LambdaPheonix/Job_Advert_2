<?php 
    
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
    <?php require '/Styles/site.css';?>
</style>
</head>
<body>
    
    <div id="nav_bar">
        <?php require 'Session.php';?>
    </div>
</body>

<?php

// sets default vars to be used


foreach(array_keys($_SESSION) as $key){
    echo $key.','.$_SESSION[$key];
}
