<?php require "general/Session.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
<body>
    
    <div id="nav_bar">
        <?php require ("general\Nav_bar_html_outside.php")?>
    </div>
</body>

<?php

// sets default vars to be used


foreach(array_keys($_SESSION) as $key){
    echo $key.','.$_SESSION[$key];
}
