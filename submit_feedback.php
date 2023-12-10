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

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the feedback is not empty
    if (empty(trim($_POST["feedback"]))) {
        
        $message = "Feedback can't be empty";
        $redirectUrl = "index.php";
        function_alert($message, $redirectUrl);
    }
  else {
        $feedback = $_POST["feedback"];
        
        // Prepare and bind the INSERT statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO feedback (feedback) VALUES (?)");
        $stmt->bind_param("s", $feedback);

        if ($stmt->execute()) {
            $message = "Thanks..!\\nWe Received Your Feedback";
            $redirectUrl = "index.php";
            function_alert($message, $redirectUrl);
        } else {
                
        }
        $stmt->close();
    }
}