<?php
require "../Session.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <style> <?php include '../Styles/site.css' ?></style>
    </head>
    <body>
        <div class="back_box">
            <header class="bg">
                <h1>Login here</h1>
            </header>
            <br>
            <div class="bg">
                <form action="Login_processing.php" method="post" id="Login_in">
                    <label for="uname">enter user name:</label><br>
                    <input type="text" id="uname" name="uname"><br><br>

                    <label for="psw">Enter Password:</label><br>
                    <input type="password" name="psw" id="psw"><br><br>
                    
                    <input type="submit" name="submit">

                </form>
            </div>
        </div>
    </body>