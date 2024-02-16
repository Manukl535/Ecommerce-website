<?php
include('Includes/connection.php');

// Check if the order_id is set in the form data
if (isset($_POST['cancel_order'])) {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        // Delete from order_item table
        $stmt1 = $conn->prepare("DELETE FROM order_item WHERE order_id = ?");
        $stmt1->bind_param('i', $order_id);

        if ($stmt1->execute()) {
            // Delete from orders table
            $stmt2 = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
            $stmt2->bind_param('i', $order_id);

            if ($stmt2->execute()) {
                // Unset the order_id from the session
                unset($_SESSION['order_id']);
                header('location: account.php');
                exit();
            } else {
                // Handle the case where deleting from orders table fails
                // echo "Error deleting from orders table.";
                header('location: account.php?error=delete_orders_failed');
                exit();
            }
        } else {
            // Handle the case where deleting from order_item table fails
            // echo "Error deleting from order_item table.";
            header('location: account.php?error=delete_order_items_failed');
            exit();
        }
    } else {
        // Handle the case where order_id is not set
        header('location: account.php?error=order_id_not_set');
        exit();
    }
} else {
    // Handle the case where cancel_order is not set
    header('location: account.php?error=cancel_order_not_set');
    exit();
}
?>
