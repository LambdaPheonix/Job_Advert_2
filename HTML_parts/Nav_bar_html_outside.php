<?php require "Styles/Login_swap.php"; ?>

<link rel="stylesheet" href='/Styles/site.css' >
<nav>
    <ul>
        <li><a class='log_in_done' href=<?= "Login\Login_form.php" ?>>Login</a></li>
        <li><a href=<?= "Job_ad_manipulation\Jobs_displayed.php" ?>>Jobs Available</a></li>
        <li class="logged_in"><a href=<?= "Login\Jobs_view_data.php" ?>>Job Advert data</a></li>
        <li><a href=<?= "general\ad_date.php" ?>>ad_date</a></li>
    </ul>
</nav>

