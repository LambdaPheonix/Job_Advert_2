<?php
require '../Session.php';
?>
<?php
    unset($_SESSION['Logged']);
    $_SESSION['Logged'] = 0;
    unset($_SESSION['uname']);
    header('Location: http://localhost/Job_advert_2/index.php');
    exit();
?>
<style>
    <?php require '../Styles/site.css';?>
</style>


