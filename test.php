
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="container">
  <h2>Checkout Form</h2>
  <form id="checkout" action="Includes/place_order.php" method="POST">
    <div class="row">
      <div class="col-50">
        <h3>Shipping Address</h3>
        <label for="fname"><i class="fa fa-user"></i> Full Name</label>
        <input type="text" id="fname" name="name" placeholder="SRISHA L" required>
        <button type="submit" class="btn btn-primary">Place Order</button>
        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>

              <input type="text" id="adr" name="address" placeholder="#123,15th Street" required>
        
              <label for="email"><i class="fa fa-envelope"></i> Email</label>

              <input type="text" id="email" name="email" placeholder="srisha@example.com" required>
            </div>
  
            <div class="col-50">
           <?php echo "<h3>Cart Qty: " . $_SESSION['total_items'] . "</h3>";?>
             
            

               <label for="btn"><i class="fa">&#xf041;</i> State</label>

              <input type="text" id="state" name="state" placeholder="Karnataka" required> 
              
              <label for="btn"><i class="fa">	&#xf08d;</i> City</label>

              <input type="text" id="state" name="city" placeholder="Bengaluru" required> 

  
              <label for="deliverydate"><i class="fa">&#xf274;</i> Date Of Delivery</label>
              
              <input type="date" id="deliverydate" name="dod" required>

     
              
                
                </div>
              </div>
              <label for="phone"><i class="fa">&#xf095;</i> Phone</label> 

            <input type="text" id="phone" name="phone" placeholder="93425 32878" required>

            <center><label for="total_amount"><b><i class="fa"></i></b> Total Amount: &#8377; <?php echo $_SESSION['total']; ?><center></label><br/> 

             
            </div>
           </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

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
        <img src="Assets/qr.png" class="img-fluid" alt="Centered Image">
        <p>Is Payment successful?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" style="background-color: red;" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success" style="background-color: green;" data-dismiss="modal">Yes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  document.getElementById('checkout').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    var fullName = document.getElementById('fname').value;

    if (fullName) {
      // If the input is provided, show the modal
      $('#paymentModal').modal('show');
    } else {
      // If the input is not provided, you can display an error message or take any other appropriate action
      alert('Please provide your full name');
    }
  });
</script>
</body>
</html>