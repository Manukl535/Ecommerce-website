<?php
// login.php

$host = "localhost";
$username = "root";
$password = "";
$database = "usersdb";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$enteredUsername = $_POST['username'];
$enteredPassword = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$enteredUsername' AND password='$enteredPassword'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Login successful!";
	$row = $result->fetch_assoc();
        // Verify the entered password against the hashed password in the database
        if (password_verify($enteredPassword, $row['password'])) {
            // Authentication successful, redirect to home page
            header("C:/xampp/htdocs/Ecom/index.html");
            exit();
        }
} else {
    echo "Login failed. Invalid username or password.";
}

$conn->close();
?>
