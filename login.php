<?php
// login.php

// Start the session
session_start();

function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}

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

// Use prepared statements to prevent SQL injection
$query = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $enteredUsername, $enteredPassword);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Authentication successful, set session variables
    $_SESSION['username'] = $enteredUsername;
    $_SESSION['loggedin'] = true;

    // Redirect to the index page
    header("Location: index.html");
    exit;
} else {
    $message = "Invalid Username or Password";
    $redirectUrl = "login.html";
    function_alert($message, $redirectUrl);
}

$stmt->close();
$conn->close();
?>