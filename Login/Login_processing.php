<?php
require "../Session.php";
require "../Server_details.php";



// init varibles
$msg = $tbl = $uname = $psw = '';

// tbl to pull data from
$tbl = 'tbl_users';

// cleaning incoming vars
$uname = sanitizeInput($_POST['uname']);
$psw = sanitizeInput($_POST['psw']);

if (check_username_password($uname,$psw,$tbl,$msg)){
    $_SESSION['Logged'] = 1;
    echo_msg ($msg);
    login_catchup();
    //header('/index.htm');
} else {
    echo_msg($msg);
    //header('Login_form.php');

}

?>
<style>
    <?php require '../Styles/site.css';?>
</style>




