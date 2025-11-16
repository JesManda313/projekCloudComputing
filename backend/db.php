<?php
$host = "flynow-db.ctwsanreln2y.us-east-1.rds.amazonaws.com";
$username = "admin";
$password = "FlyNow2025!";
$database = "flynow_db";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
