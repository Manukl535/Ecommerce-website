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

 // Check if the username is available
 $checkQuery = "SELECT * FROM users WHERE username = '$regUsername'";
 $result = $conn->query($checkQuery);
 if ($result->num_rows > 0) {
     $message = "Username not available! Please choose a different username.";
     $redirectUrl = "register.html";
     function_alert($message, $redirectUrl);
 }
else{
    // Insert new user into the database
    $insertQuery = "INSERT INTO users (username, password) VALUES ('$regUsername', '$regPassword')";
    if ($conn->query($insertQuery) === TRUE) {
        
        //echo "Registration successful! Kindly Go Back & Login With Your Credentials";
       
        $message = "Registration successful! Redirecting to Login Page";
        $redirectUrl = "login.html";
        function_alert($message, $redirectUrl);
  }
}
}
 else {
        //Future Use with appropriate message
    } 
$conn->close();
?>