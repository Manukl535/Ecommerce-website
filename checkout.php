<?php
  session_start();
  if (!empty($_SESSION['cart']) && isset($_POST['checkout'])) {
  } else {
    header('location:index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <style>
 
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
    width: 50%;
  margin: 0 auto;
  background-color: lavender;
  padding: 50px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
input[type=email] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
input[type=date] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}
.location{
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
  background-color:blue;
  color: white;
  font-size: 17px;
}
.location:hover{
    background-color: blue; 
}
label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: 	rgb(87, 158, 238);
  color: white;
  padding: 9px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
  
}

.btn:hover {
  background-color: #45a049;
  color: #fff;
  
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}

input[type=submit]{
  
}

</style>

</head>

<body>

<center><h2><u>Checkout</u></h2></center>

<div class="row">
    <div class="col-75">
        <div class="container">
            <form action="Includes/place_order.php" method="POST">

                <div class="row">
                    <div class="col-50">
                        <h3>Shipping Address</h3>
                        <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                        <input type="text" id="fname" name="name" placeholder="SRISHA L" required>

                        <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                        <input type="text" id="adr" name="address" placeholder="#123,15th Street" required>

                        <label for="email"><i class="fa fa-envelope"></i> Email</label>
                        <input type="email"  id="email" name="email" placeholder="srisha@gmail.com" required>
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
                <input type="text" id="phone" name="phone" placeholder="93425 32878" pattern="[0-9]{10}" title="Enter the Mobile number" required>

                <center><label for="total_amount"><b><i class="fa"></i></b> Total Amount: &#8377; <?php echo $_SESSION['total']; ?><center></label><br/>

                <input type="submit" value="Place Order" name ="place_order" class="btn" data-target="#paymentModal" data-toggle="modal">
            </form>
        </div>
    </div>
</div>

<script>
  // Get the current date
  var today = new Date();
  // Get tomorrow's date
  var tomorrow = new Date(today);
  tomorrow.setDate(tomorrow.getDate() + 1);

  // Get the last day of the current month
  var lastDay = new Date(today.getFullYear(), today.getMonth() + 1, 0);

  // Set the minimum and maximum attributes of the input element
  document.getElementById("deliverydate").setAttribute("min", tomorrow.toISOString().split('T')[0]);
  document.getElementById("deliverydate").setAttribute("max", lastDay.toISOString().split('T')[0]);
</script>

<br>
<br/>

  <center>
    <div class="copyright">
        <p>2023 &#169; All Rights Reserved</p><p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
    </div>
</center>

</body>
</html>