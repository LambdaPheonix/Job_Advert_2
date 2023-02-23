<?php
require "/general/Session.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test filters</title>
    </head>
    <body>
        <h1>to test filters</h1>
        <form action="filter_return" id="filter_c" method="post">
            <label for="region">enter region:</label><br>
            <input  id="region" type="text" name="region"> <br><br>
            <input type="hidden" name="returnFilter" value="1">
            <input type="submit" name="submit">
        </form>
        <
    </body>