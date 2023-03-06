<?php
require "../Session.php";
//require "../Server_details.php";
?>

<script>
    var nav_div = document.getElementsByid('nav_div');
    nav.remove();
</script>


<?php
// init varibles
$msg = $tbl = $uname = $psw = '';

// tbl to pull data from
$tbl = 'tbl_users';

// cleaning incoming vars
$uname = sanitizeInput($_POST['uname']);
$psw = sanitizeInput($_POST['psw']);

// checking if login details are valid
if (check_username_password($uname,$psw,$tbl,$msg)){
    $_SESSION['Logged'] = 1;
    $_SESSION['uname'] = $uname;
    echo_msg ($msg);
    Login_API($uname,$psw);
    SwapLogin(1);
    header('Location: http://localhost/Job_advert_2/index.php');
    exit();

} else {
    echo_msg($msg);
    SwapLogin(0);
    //unset($_SESSION['uname']);
    header("Location: http://localhost/Job_advert_2/Login/Login_form.php");
    exit();

}

?>
<style>
    <?php require '../Styles/site.css';?>
</style>




