<?php
session_start();
include('Includes/connection.php');

// Check if the shipped address is available in the session
if (isset($_SESSION['shipped_address'])) {
    $shipped_address = $_SESSION['shipped_address'];
} else {
    // Handle the case when shipped_address is not set
    // You may want to redirect the user or display an error message
}

// Check if the form is submitted via POST
if (isset($_POST['continue-btn'])) {
    // Sanitize and retrieve form data
    $reason = isset($_POST['reason']) ? htmlspecialchars($_POST['reason']) : '';
    $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : '';

    // Retrieve required information from the orders table
    $order_id = $_SESSION['order_id'];
    $user_id = $_SESSION['user_id'];

    $stmtOrders = $conn->prepare("SELECT user_name, user_phone, user_address, user_city, user_state FROM orders WHERE order_id=? AND user_id=?");
    $stmtOrders->bind_param('ii', $order_id, $user_id);
    $stmtOrders->execute();
    $ordersResult = $stmtOrders->get_result()->fetch_assoc();

    $stmtOrders->close();

    // Insert the return request into the database
    $stmtReturn = $conn->prepare("INSERT INTO return_requests (order_id, user_id, reason, comments, user_name, user_phone, user_address, user_city, user_state) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtReturn->bind_param('iisssssss', $order_id, $user_id, $reason, $comments, $ordersResult['user_name'], $ordersResult['user_phone'], $ordersResult['user_address'], $ordersResult['user_city'], $ordersResult['user_state']);

    if ($stmtReturn->execute()) {
        // Success, display alert and redirect
        echo '<script>alert("Return request accepted. Refund will be processed.");</script>';
        header('location: orders_details.php?order_id=' . $order_id . '&orders_btn=true');
        exit();
    } else {
        // Failed to insert into the database, handle accordingly
        echo '<script>alert("Failed to submit return request. Please try again.");</script>';
    }

    $stmtReturn->close();
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your existing meta tags) ... -->
</head>
<body>

<div class="container">
    <form action="product_return.php" method="post">
        <!-- ... (your existing form elements) ... -->

        <div class="pickup-address-header">Pickup Address</div>

        <!-- Display the user's address received from the session -->
        <!-- Display the shipped address in the form -->
        <p><?php echo isset($shipped_address['user_name']) ? $shipped_address['user_name'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_address']) ? $shipped_address['user_address'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_city']) ? $shipped_address['user_city'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_state']) ? $shipped_address['user_state'] : ''; ?></p>
        <p><?php echo isset($shipped_address['user_phone']) ? $shipped_address['user_phone'] : ''; ?></p><br/>

        <br/>
        <button type="submit"  name="continue-btn" class="continue-button">Continue</button>
    </form>
</div>

</body>
</html>
