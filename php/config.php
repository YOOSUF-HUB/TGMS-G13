<?php
// Define Database configuration
$servername = "localhost"; 
$username = "root";
$password = "";
$dbname = "textile";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
