<?php
    session_start();
    // import file
    $import = ( file_exists("../general/General_functions.php")) ? 
    require "../general/General_functions.php" : require "general/General_functions.php";
    echo $import;
    
    
    if ($_SESSION['Logged'] == 1){
        SwapLogin(1);
    } else {
        SwapLogin(0);
    }
    if($_SESSION['Catch_up'] !== $_SESSION["Logged"]){
        $_SESSION['Catch_up'] = $_SESSION["Logged"];
        echo "<script>location.reload();</script>";
    }
    





    