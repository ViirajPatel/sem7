<?php

// if ($userid == $_COOKIE["userid"]) {
$zipcode = $_COOKIE["zipcode"];
include("header.php");
include("menu_admin.php");
?>

<hr>
<div class="container">
    <?php
        include "showcropinfo.php";
    ?>

</div>
<hr>
<?php
include("footer.php");
?>