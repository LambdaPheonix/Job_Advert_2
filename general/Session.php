<?php
    // starts session to move vars around and check logged status
    session_start();

    if (!array_key_exists('logged',$_SESSION) ){
        $_SESSION['Logged'] = 0;

    }

    