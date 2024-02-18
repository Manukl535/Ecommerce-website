<?php
// Start the session if not started already
session_start();

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
        padding: 20px;
    }

    #topproduct .product1 button:hover {
        background-color: #d9534f;
        color: white; /* Add text color to make it visible */
    }

    #topproduct .product img {
        width: 80%;
        max-width: 100%;
        height: auto;
    }

    #topproduct .product .description {
        text-align: start;
        padding: 10px 0;
    }

    #topproduct .product h4 {
        color: #088178;
    }

    #topproduct .Collection {
        display: flex;
        justify-content: space-between;
        padding-top: 20px;
    }
    button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 50%;
        }

        button:hover {
            background-color: #45a049;
        }
</style>

</head>
<body>
 
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <div class="product1">
                <h4>Scan The QR Code to Make Payment</h4>
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
            <button type="submit" name="cancel_order" class="btn btn-danger" style="background-color: red;" onclick="showFailureAlert()">No</button>
            <button type="button" class="btn btn-success" style="background-color: green;" onclick="showSuccessAlert()">Yes</button><p></p>
            <p><button type="submit" name="cancel_order" class="btn btn-danger" style="background-color: red;" onclick="CancelAlert()">Cancel Payment</button></p>
        </form>
    <?php }  ?>
            </div>
        </div>
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
    window.onpopstate = function () {
      history.go(1);
    };
  </script>
</body>
</html>
