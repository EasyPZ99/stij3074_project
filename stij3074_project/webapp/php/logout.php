<?php
session_start();
unset($_SESSION["sessionadmin"]);
unset($_SESSION["sessionid"]);
unset($_SESSION["user_email"]);
unset($_SESSION["user_name"]);
header("Location:login.php");
?>