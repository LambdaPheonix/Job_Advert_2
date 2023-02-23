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
        $_SESSION['client'] = $client_info[0];
        $_SESSION['client_id'] = $client_info[1];
    } else {
        if(empty($_SESSION['client'])){

            //$client_info = createSoapClient();
            $_SESSION['client'] = $client_info[0];    
        }
    }



    