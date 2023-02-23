<?php
require "../general/Session.php";

require "../Styles/Login_swap.php";

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <link rel="stylesheet" href='/Styles/site.css' >
    </head>
    <body>
        <header class="bg">
            <h1>Login here</h1>
        </header>
        <div class="bg">
            <form action="Login_processing.php" method="post" id="Login_in">
                <label for="uname">enter user name:</label><br>
                <input type="text" id="uname" name="uname"><br><br>

                <label for="psw">Enter Password:</label><br>
                <input type="password" name="psw" id="psw"><br><br>
                
                <input type="submit" name="submit">

            </form>
        </div>
    </body>