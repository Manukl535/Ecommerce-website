<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regUsername = $_POST['first_name'];
    $regPassword = $_POST['password'];



    // Insert new user into the database
    $insertQuery = "INSERT INTO users (username, password) VALUES ('$regUsername', '$regPassword')";
    if ($conn->query($insertQuery) === TRUE) {
        
        //echo "Registration successful! Kindly Go Back & Login With Your Credentials";
       
        $message = "Registration successful! Redirecting to Login";
        $redirectUrl = "login.html";
        function_alert($message, $redirectUrl);
  }
}
 else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }


$conn->close();
?>