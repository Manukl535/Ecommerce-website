<?php
// Include database connection or any necessary files
include('Includes/connection.php');

// Check if the bank value is provided in the request
if (isset($_GET['bank'])) {
    $bank = $_GET['bank'];

    // Query to fetch bank details based on the selected bank
    $stmt = $conn->prepare("SELECT account_number, ifsc_code FROM return_requests WHERE bank = ?");
    $stmt->bind_param("s", $bank);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query executed successfully
    if ($result) {
        // Check if any rows are returned
        if ($result->num_rows > 0) {
            // Fetch bank details
            $bankDetails = $result->fetch_assoc();

            // Return bank details as JSON
            echo json_encode($bankDetails);
        } else {
            // If no matching bank details found, return an empty object
            echo json_encode(array());
        }
    } else {
        // If an error occurred during the query execution, return an error message
        echo "Error: Unable to fetch bank details";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If bank value is not provided in the request, return an error message
    echo "Error: Bank value not provided";
}
?>
