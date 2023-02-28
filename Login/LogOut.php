<?php
require '../Session.php';
?>
<script>
    var nav_div = document.getElementsByid('nav_div');
    nav.remove();
</script>
<?php
unset($_SESSION['Logged']);
$_SESSION['Logged'] = 0;
SwapLogin(0);
?>
<style>
    <?php require '../Styles/site.css';?>
</style>


