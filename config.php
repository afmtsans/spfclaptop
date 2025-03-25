<?php
// error_reporting(E_ERROR);
$servername = "afmediatech.site";
$username = "afmediat_spfc";
$password = "Anjali720p";
$dbname="afmediat_spfc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>