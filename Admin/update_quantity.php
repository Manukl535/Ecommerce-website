<?php
// Include the database connection
include('../Includes/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $newQuantity = $_POST['new_quantity'];

    // Prepare and execute the UPDATE query
    $updateProductStmt = $conn->prepare("UPDATE products SET available_qty = ? WHERE product_id = ?");
    $updateProductStmt->bind_param('ii', $newQuantity, $productId);
    $updateProductStmt->execute();
    $updateProductStmt->close();

    echo 'Quantity updated successfully';
} else {
    echo 'Invalid request';
}
?>
