<?php
require "../general/Session.php";
require "../Server_details.php";
//require "../general/General_functions.php";
require "../Styles/Login_swap.php";

// init varibles
$msg = $tbl = $uname = $psw = '';

// tbl to pull data from
$tbl = 'tbl_users';

// cleaning incoming vars
$uname = sanitizeInput($_POST['uname']);
$psw = sanitizeInput($_POST['psw']);

if (check_username_password($uname,$psw,$tbl,$msg)){
    $_SESSION['Logged'] = 1;
    echo_msg($msg);
    header('/index.htm');
} else {
    echo_msg($msg);
    header('Login_form.php');

}
echo WrapTag($_SESSION['Logged'],'h1');


