<?php
// Establish a connection to the database
$host = "localhost";
$username = "root";
$password = "";
$database = "usersdb";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>