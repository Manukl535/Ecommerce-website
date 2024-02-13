<?php 



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Place Order</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    <style>
  /* Custom CSS for Confirmation Modal */
  #successModal .modal-content {
    background-color: #f8f9fa; /* Light background color */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  }

  #successModal .modal-body {
    padding: 40px; /* Increased padding for better spacing */
  }

  #successModal .modal-title {
    font-size: 24px; /* Larger title font size */
    color: #28a745; /* Green color for success */
  }

  #successModal.modal-title h5{
    text-align: center;
  }

  #successModal .btn-primary {
    background-color: #007bff; /* Blue color for the "Continue Shopping" button */
    border-color: #007bff;
  }

  #successModal .btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
    border-color: #0056b3;
  }


  #failureModal .modal-content {
    background-color: #f8f9fa; /* Light background color */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
  }

  #failureModal .modal-body {
    padding: 40px; /* Increased padding for better spacing */
  }

  #failureModal .modal-title {
    font-size: 24px; /* Larger title font size */
    color: red; /* Green color for success */
  }

  #successModal.modal-title h5{
    text-align: center;
  }

  #failureModal .btn-primary {
    background-color: #007bff; /* Blue color for the "Continue Shopping" button */
    border-color: #007bff;
  }

  #failureModal .btn-primary:hover {
    background-color: #0056b3; /* Darker blue on hover */
    border-color: #0056b3;
  }
</style>
  </style>
</head>
<body>

  <!-- Modal for Payment Status -->
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <button onclick="history.back()"  style='background-color:white'><span style='font-size:20px; background-color:white'>&#129092;</span></button>
          <h5 class="modal-title" id="paymentModalLabel">Payment Status</h5>
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <h4>Scan The QR Code to Make Payment</h4>
          <p>Total Payment: &#8377; <?php echo $_SESSION['total'] ?></p>
          <img src="Assets/qr.png" class="img-fluid" alt="Centered Image">
          <p>Is Payment Successful?</p>
        </div>
        <div class="modal-footer">
          <button id="noBtn" type="button" name='payment_fail' class="btn btn-danger" style="background-color: red;" data-dismiss="modal">No</button>
          <button id="yesBtn" type="button" name='payment_success' class="btn btn-success" style="background-color: green;" data-dismiss="modal">Yes</button>
         
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Payment Success -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        
          <h5 class="modal-title" text="center" id="successModalLabel"><img src="Assets/payment_suxs.png" alt="">Payment Success</h5>
          
          <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p>Payment was successful!</p>
          <p>"Order Placed Successfully"</p>
          <p>Amount Paid: &#8377; <?php echo $_SESSION['total'] ?></p>
          <a href="shop_1.php"><button class="btn btn-primary">Continue Shopping</button></a>
          </div>
      </div>
    </div>
  </div>

  <!-- Modal for Payment Failure -->
  <div class="modal fade" id="failureModal" tabindex="-1" role="dialog" aria-labelledby="failureModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="failureModalLabel">Payment Failure</h5>
        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"> -->
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p style="font-weight:bold">Payment Failed.</p>
        <p style="font-weight:bold; color:red">Sorry, Your order was Unsuccessful</p>
        
        
        <a href="cart.php"><button class="btn btn-primary">Try again</button></a>
      </div>
    </div>
  </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Include Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Include Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    // Show the payment modal when the page finishes loading
    $('#paymentModal').modal('show');

    // Handle the "Yes" button click event to show success modal
    $('#yesBtn').on('click', function() {
      // You can add your logic here to determine if payment was successful
      // For now, let's assume paymentSuccess is a boolean variable
      var paymentSuccess = true; // Change this based on your actual logic

      if (paymentSuccess) {
        $('#successModal').modal('show');
      } else {
        $('#failureModal').modal('show');
      }
    });

    // Handle the "No" button click event to show failure modal
    $('#noBtn').on('click', function() {
      $('#failureModal').modal('show');
    });
  });
</script>
</body>
</html>