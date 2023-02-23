<?php
    // starts session to move vars around and check logged status
    
    if (empty($_SESSION)){
        session_start();
        if (!array_key_exists('logged',$_SESSION) ){
            $_SESSION['Logged'] = 0;

        }
    }
    if (!array_key_exists('client',$_SESSION)){
        $client_info = createSoapClient_1();

    } 



    