<?php
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
          <a href="shop_1.php" class="btn btn-primary">Continue Shopping</a>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="container">
    <div class="text-center mt-5">
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
          <button type="submit" name="cancel_order" class="btn btn-danger" style="background-color: red;">No</button>
          <button type="button" class="btn btn-success" style="background-color: green;" data-toggle="modal" data-target="#successModal">Yes</button>
        </form>
      <?php } else { ?>
        <!-- Disable buttons when payment cost is 0 -->
        <button type="button" class="btn btn-danger" style="background-color: red;" disabled>No</button>
        <button type="button" class="btn btn-success" style="background-color: green;" disabled data-toggle="modal" data-target="#failureModal">Yes</button>
      <?php } ?>
    </div>
  </div>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Payment Success</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Payment was successful! Order Placed Successfully.</p>
          <p>Amount Paid: &#8377; <?php echo $_SESSION['total'] ?></p>
          <div class="container text-center mt-5">
          <a href="shop_1.php" class="btn btn-primary" algin='center'>Continue Shopping</a></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Failure Modal -->
  <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="failureModalLabel">Payment Failure</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Payment failed. Sorry, your order was unsuccessful.</p>
          <div class="container text-center mt-5">
          <a href="cart.php" class="btn btn-primary" algin='center'>Try again</a></div>
        </div>
      </div>
    </div>
  </div>

  </body>
</html>
