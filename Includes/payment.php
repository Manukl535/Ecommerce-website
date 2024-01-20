<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Place Order</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

  <!-- Modal for Payment Status -->
  <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentModalLabel">Payment Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <h4>Scan The QR Code to Make Payment</h4>
          <img src="qr.png" class="img-fluid" alt="Centered Image">
          <p>Is Payment successful?</p>
        </div>
        <div class="modal-footer">
          <button id="noBtn" type="button" class="btn btn-danger" style="background-color: red;" data-dismiss="modal">No</button>
          <button id="yesBtn" type="button" class="btn btn-success" style="background-color: green;" data-dismiss="modal">Yes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal for Payment Success -->
  <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="successModalLabel">Payment Success</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <p>Payment was successful!</p>
          
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p>Payment was not successful.</p>
        <a href="shop.php"><button class="btn btn-primary">Continue Shopping</button></a>
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