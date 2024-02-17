<?php
session_start();
include('Includes/connection.php');
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

 

    // Example: Delete order from orders table
    $deleteOrderQuery = "DELETE * FROM orders WHERE order_id = $order_id";
    mysqli_query($conn, $deleteOrderQuery);

    // Example: Delete order items from order_item table
    $deleteOrderItemsQuery = "DELETE * FROM order_item WHERE order_id = $order_id";
    mysqli_query($conn, $deleteOrderItemsQuery);

    // Close the database connection
    mysqli_close($conn);

    header('location:account.php')
}
?>
