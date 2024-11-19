<?php
$servername = "localhost";
$username = "rap_user";
$password = "2000";
$dbname = "rapsol";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>