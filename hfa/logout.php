<?php
include_once "conn.php";
$userid = $_COOKIE["userid"];
$zipcode = $_COOKIE["zipcode"];
$type = $_COOKIE["type"];

setcookie("zipcode", $zipcode, time() - 3600, "/", "", 0);
setcookie("userid", $userid, time() - 3600, "/", "", 0);
setcookie("type", $type, time() - 3600, "/", "", 0);

header("Location: login.php");

?>