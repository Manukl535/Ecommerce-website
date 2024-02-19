<?php
// Start the session if not started already
session_start();
include('Includes/connection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location: login.php');
    exit();
}

// Check if the cart is empty
if (isset($_SESSION['total']) && $_SESSION['total'] == 0) {
    // Display a simple message for an empty cart
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
      <div class="container">
        <div class="text-center mt-5">
          <h5>No Orders</h5>
          <p>You have no orders.</p>
          <a href="cart.php" class="btn btn-primary">Continue Shopping</a>
        </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>';

    exit; // Stop executing the rest of the script
}

// Assuming you have a button or link in checkout.php to go back to cart.php
if (isset($_POST['back_to_cart'])) {
    // Assuming the session variable 'order_id' holds the current order ID
    $order_id = $_SESSION['order_id'];

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
            $error_message = mysqli_error($conn);
            error_log("Error deleting from orders table: $error_message");
            header('location: checkout.php?error=delete_orders_failed');
            exit();
        }
    } else {
        // Handle the case where deleting from order_item table fails
        $error_message = mysqli_error($conn);
        error_log("Error deleting from order_item table: $error_message");
        header('location: checkout.php?error=delete_order_items_failed');
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Place Order</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<body>
<style>
    body {
        text-align: center;
    }

    .section-p1 {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
    }

    #topproduct .product1 {
        width: 90%;
        max-width: 600px;
        margin: 0 auto;
        position: relative;
        border-radius: 50px;
        box-sizing: border-box;
        border: 2px solid beige;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }  

    #topproduct .product img {
        width: 90%;
        max-width: 100%;
        height: auto;
        box-sizing: border-box;
        border: 2px solid beige;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    #topproduct .product .description {
        text-align: start;
        padding: 10px 0;
    }

    #topproduct .product h5 {
        color: #088178;
        font weight:bold;
    }

    #topproduct .product p {
        color: #088178;
    }

    #topproduct .Collection {
        display: flex;
        justify-content: space-between;
        padding-top: 20px;
    }

    #topproduct .product1 button.btn {
        transition: border-color 0.3s ease-in-out, transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        &:hover {
          border-color: #c0c0c0; 
          transform: scale(1.05); 
          box-shadow: 0 0 12px rgba(200, 200, 200, 0.9); 
        }
    }

</style>

</head>
<body>
 
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <div class="product1">
                <h5>Scan The QR Code to Make Payment</h5>
    <p>Total Payment: &#8377; <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) {
        echo $_SESSION['total'];
    } ?></p>
    <img src="Assets/qr.png" class="img-fluid" alt="Centered Image">
    <p>Is Payment Successful?</p>

    <?php if (isset($_SESSION['total']) && $_SESSION['total'] > 0) { ?>
        <form method="post" action="place_order.php">
            <?php if (isset($_SESSION['order_id'])) { ?>
                <input type="hidden" name="order_id" value="<?php echo $_SESSION['order_id']; ?>">
            <?php } ?>
            <button type="submit" name="cancel_order" class="btn btn-danger" style="background-color: red" onclick="showFailureAlert()"><b>No</b></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="button" class="btn btn-success" style="background-color: green;" onclick="showSuccessAlert()"><b>Yes</b></button><p></p>
            <p><button type="submit" name="cancel_order" class="btn btn-danger" style="background-color: red;" onclick="CancelAlert()"><b>Cancel Payment</b></button></p>
            
        </form>
    <?php }  ?>
            </div>
            
        </div>
        <p>Please Don't Go Back Or Refresh</p>
        <script>
    function showFailureAlert() {
      alert("Payment failed!.\n Sorry, your order was unsuccessful.");
      window.location.href = "cart.php";
    }

    function showSuccessAlert() {
      var totalAmount = <?php echo $_SESSION['total']; ?>;
      alert("Payment was successful! Order Placed Successfully.\nAmount Paid: ₹" + totalAmount);
      window.location.href = "cart.php";
    }

    function CancelAlert() {
      alert("Payment Canceled.");
      window.location.href = "cart.php";
    }

    // Disable the back button after successful payment
    history.pushState(null, null, location.href);
    window.onpopstate = function (event) {
        alert("Back button disabled. Please use the provided buttons.");
        history.pushState(null, null, location.href);
        event.preventDefault();
    };
  </script>
</body>
</html>
