<?php

    // starts session to move vars around and check logged status
    
    if (empty($_SESSION)){
        session_start();
        $keys = array_keys($_SESSION);
        
        //display_array($_SESSION);
        //display_array($keys);
        if (!array_key_exists('logged',$_SESSION) ){
            
            $_SESSION['Logged'] = 0;

        }
    }
    if (!array_key_exists('client',$_SESSION)){
        $client_info = createSoapClient_1();

    } 



    