<?php
// Include the database connection file
include('Includes/connection.php');

// Function to display an alert and redirect
function function_alert($message, $redirectUrl) {
    // Display the alert box
    echo "<script>alert('$message');</script>";
    // Redirect to the specified URL after the alert is closed
    echo "<script>window.location.href = '$redirectUrl';</script>";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);

    // Prepare and bind the INSERT statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, phone, feedback) VALUES (?, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        $message = "Error in preparing the SQL statement";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    // Execute the statement
    $result = $stmt->execute();

    // Check for errors in executing the statement
    if (!$result) {
        $message = "Error in executing the SQL statement: " . $stmt->error;
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    }

    // Close the statement
    $stmt->close();

    // Check if the execution was successful
    if ($result) {
        $message = "Thanks..!\\nWe Received Your Feedback";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    } else {
        // Handle the case when the insertion fails
        $message = "Failed to submit feedback. Please try again.";
        $redirectUrl = "index.php"; // Adjust the URL
        function_alert($message, $redirectUrl);
    }
}
?>
