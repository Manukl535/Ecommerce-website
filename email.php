<?php
 function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}
$email = $_POST['email'];
$host = "localhost";
$username = "root";
$password = "";
$database = "usersdb";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $regemail = $_POST['email'];
    // $regPassword = $_POST['password'];

 // Check if the username is available
 $checkQuery = "SELECT * FROM email WHERE email = '$regemail'";
 $result = $conn->query($checkQuery);
 if ($result->num_rows > 0) {
     $message = "Email already used";
     $redirectUrl = "index.html";
     function_alert($message, $redirectUrl);
 }
else{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Insert new user into the database
    $insertQuery = "INSERT INTO email VALUES ('$regemail')";
    if ($conn->query($insertQuery) === TRUE) {
             
        $message = "Thanks for your interest!";
        $redirectUrl = "index.html";
        function_alert($message, $redirectUrl);
  }
}
else
{
    $message = "Invalid Email";
    $redirectUrl = "index.html";
    function_alert($message, $redirectUrl);
}
}
}
 else {
        //Future Use with appropriate message
    } 
$conn->close();
?>





