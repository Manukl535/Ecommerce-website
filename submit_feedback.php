<?php
function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}

// Assuming you have already established a connection to your database
// Replace <link>DB_HOST</link>, <link>DB_USER</link>, <link>DB_PASSWORD</link>, and <link>DB_NAME</link> with your actual database credentials
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
    if (empty($_POST["feedback"])) {
        $message = "Feedback can't be empty";
        $redirectUrl = "index.html";
        function_alert($message, $redirectUrl);
    } else {
        $feedback = $_POST["feedback"];
        // Prepare and bind the INSERT statement to avoid SQL injection
        $stmt = $conn->prepare("INSERT INTO feedback_table (feedback) VALUES (?)");
        $stmt->bind_param("s", $feedback);

        if ($stmt->execute()) {
            $message = "Thanks for your interest";
            $redirectUrl = "index.html";
            function_alert($message, $redirectUrl);
        } else {
            echo "Error: " . $conn->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>