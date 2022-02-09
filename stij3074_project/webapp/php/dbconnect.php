<?php
$servername = "localhost";
$username   = "crimsonw_easy99";
$password   = "JOxC17v7mIXl";
$dbname     = "crimsonw_271843_myshopdb";

try {
   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>