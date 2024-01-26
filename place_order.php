<?php
session_start();
include('Includes/connection.php');
include('payment.php');

if (isset($_POST['place_order'])) {

    //user information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $order_cost = $_SESSION['total'];
    $order_status = "on_hold";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');
    $state = $_POST['state'];
    $dod = $_POST['dod'];
    $product_quantity=$_SESSION['total_items'];

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date,order_quantity) VALUES (?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->bind_param('isssssss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date,$product_quantity);
    $stmt->execute();

    $order_id = $conn->insert_id;

   //get product

   $_SESSION['cart'];
   foreach ($_SESSION['cart'] as $key => $value){
    
    $product = $_SESSION['cart'][$key];

    $product_id = $product['product_id'];
    
    $product_name = $product['product_name'];

    $product_image = $product['product_image'];

    $product_price = $product['product_price'];

    $product_quantity = $product['product_quantity'];

    $stmt1 = $conn->prepare("INSERT INTO order_item (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param('isssiiss', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
    $stmt1->execute();
}   
//Remove
// unset($_SESSION['cart']);

}
?>