<?php
    session_start();
    // import file
    $import = ( file_exists("../general/General_functions.php")) ? 
    require "../general/General_functions.php" : require "general/General_functions.php";
    echo $import;

    createSoapClient();
    if(isset($_SESSION['Logged'])){
        if ($_SESSION['Logged'] == 1){
            SwapLogin(1);

        } else {
            SwapLogin(0);
        }
    }else{
        SwapLogin(0);

    }

    





    