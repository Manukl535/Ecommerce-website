<?php
// Start the session if not started already
session_start();
include('Includes/connection.php');

if (isset($_POST['place_order'])) {
    // User information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $order_cost = $_SESSION['total'];
    $order_status = "Paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');
    $dod = $_POST['dod'];
    $product_quantity = $_SESSION['total_items'];

    // Insert order into orders table
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_name, email, user_phone, user_city, user_state, user_address, order_date, order_quantity, dod) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('isssssssssss', $order_cost, $order_status, $user_id, $name, $email, $phone, $city, $state, $address, $order_date, $product_quantity, $dod);
    $stmt->execute();

    $order_id = $conn->insert_id;

    // Get product and insert into order_item table
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $order_cost = $_SESSION['total'];
            $product_quantity = $product['product_quantity'];

            // Update available_qty in products table
            $stmt_update_qty = $conn->prepare("UPDATE products SET available_qty = available_qty - ? WHERE product_id = ?");
            $stmt_update_qty->bind_param('ii', $product_quantity, $product_id);
            $stmt_update_qty->execute();

            // Insert into order_item table
            $stmt1 = $conn->prepare("INSERT INTO order_item (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date, dod) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param('isssiisss', $order_id, $product_id, $product_name, $product_image,  $order_cost , $product_quantity, $user_id, $order_date, $dod);
            $stmt1->execute();
        }
    }

    // Remove cart-related session variables
    unset($_SESSION['cart']);

    // Set order_id in session
    $_SESSION['order_id'] = $order_id;

    // Redirect to the payment page
    header('location: payment.php');
    exit();
} elseif (isset($_POST['cancel_order']) && isset($_SESSION['order_id'])) {
    $order_id = $_SESSION['order_id'];

    // Retrieve products and quantities from order_item table
    $stmt_get_items = $conn->prepare("SELECT product_id, product_quantity FROM order_item WHERE order_id = ?");
    $stmt_get_items->bind_param('i', $order_id);
    $stmt_get_items->execute();
    $result_items = $stmt_get_items->get_result();

    // Revert available_qty in products table
    while ($row = $result_items->fetch_assoc()) {
        $product_id = $row['product_id'];
        $product_quantity = $row['product_quantity'];

        $stmt_revert_qty = $conn->prepare("UPDATE products SET available_qty = available_qty + ? WHERE product_id = ?");
        $stmt_revert_qty->bind_param('ii', $product_quantity, $product_id);
        $stmt_revert_qty->execute();
    }

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
            unset($_SESSION['total']); // Unset total to avoid displaying the previous total
            unset($_SESSION['total_items']); // Unset total_items to avoid displaying the previous total items
            header('location: cart.php');
            exit();
        } else {
            // Handle the case where deleting from orders table fails
            header('location: account.php?error=delete_orders_failed');
            exit();
        }
    } else {
        // Handle the case where deleting from order_item table fails
        header('location: account.php?error=delete_order_items_failed');
        exit();
    }
}
?>
