<?php
$servername = "localhost";
$dbuser = "root";
$dbpass = "Admin@123";
$dbname = "neeldemo_school";

// Create connection
$conn = new mysqli($servername, $dbuser, $dbpass);
$query = mysqli_select_db($conn,$dbname);
$database = mysqli_query($conn, $query);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>