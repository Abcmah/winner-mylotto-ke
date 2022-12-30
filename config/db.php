<?php
$servername = "localhost";
$username = "root";
$password = "swafi";
$DB_NAME = "db_winner";
// Create connection
$conn = new mysqli($servername, $username, $password,$DB_NAME);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>