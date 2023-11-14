<?php
// login.php
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

$query = "SELECT * FROM users WHERE username='$enteredUsername' AND password='$enteredPassword'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "Login succesfull";
 
        // Verify the entered password against the hashed password in the database
        //if ($enteredPassword ==='username' &&  $enteredPassword ==='password') {
            // Authentication successful, redirect to index page
            header("Location:index.html");
            exit;   
        }
 //}
        else {
        $message = "Invalid Username or Password";
        $redirectUrl = "login.html";
        function_alert($message, $redirectUrl);
}
$conn->close();
?>
