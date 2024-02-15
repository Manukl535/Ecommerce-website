<?php
// session_start();
include('Includes/connection.php');

if (isset($_POST['place_order'])) {
    //user information
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $order_cost = $_SESSION['total'];
    $order_status = "Not Paid";
    $user_id = $_SESSION['user_id'];
    $order_date = date('Y-m-d H:i:s');
    $state = $_POST['state'];
    $dod = $_POST['dod'];
    $product_quantity=$_SESSION['total_items'];

    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_name,email, user_phone, user_city, user_state, user_address, order_date,order_quantity,dod) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('isssssssssss', $order_cost, $order_status, $user_id, $name, $email, $phone, $city, $state, $address, $order_date, $product_quantity, $dod);
    $stmt->execute();

    $order_id = $conn->insert_id;

    //get product
    $_SESSION['cart'];
    foreach ($_SESSION['cart'] as $key => $value) {
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

    // Check if the cart is empty
    if ($_SESSION['total'] == 0) {
        // Display a simple message modal for an empty cart
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Place Order</title>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
          <div class="modal fade" id="emptyCartModal" tabindex="-1" role="dialog" aria-labelledby="emptyCartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="emptyCartModalLabel">No Orders</h5>
                </div>
                <div class="modal-body text-center">
                  <p>You have no orders.</p>
                  <a href="shop_1.php"><button class="btn btn-primary">Continue Shopping</button></a>
                </div>
              </div>
            </div>
          </div>
          <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <script>
            $(document).ready(function() {
              $("#emptyCartModal").modal("show");
            });
          </script>
        </body>
        </html>';
        exit; // Stop executing the rest of the script
    }

    // Include the payment modal HTML
    include('payment.php');
}
?>
