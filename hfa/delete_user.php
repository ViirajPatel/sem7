<?php
$username = $_GET["username"];
include_once "conn.php";

$q = "delete from user where username='$username'";
$r = mysqli_query($conn, $q);
header("Location: edit_users.php?sts=done!");
mysqli_close($conn);

?>