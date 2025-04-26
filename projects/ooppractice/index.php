<?php
$servername = "db"; //container name
$username = "devuser";
$password = "devpass";
$database = "todoapp";

//create connection
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL!";
?>
