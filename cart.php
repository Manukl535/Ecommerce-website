<?php
session_start();

if(isset($_POST['add_to_cart'])){
    
    // if cart is not empty
    if(isset($_SESSION['cart'])){

        $product_array_ids = array_column($_SESSION['cart'],"product_id");
        if( !in_array($_POST['product_id'],$product_array_ids))
        {
                $product_id = $_POST['product_id'];    

                $product_array = array(
                    'product_id' => $_POST['product_id'], 
                    'product_image' =>$_POST['product_image'], 
                    'product_name' => $_POST['product_name'], 
                    'product_price' => $_POST['product_price'], 
                    'product_quantity' => $_POST['product_quantity']
                );
        
                $_SESSION['cart'][$product_id] = $product_array;

        }else{
            echo '<script>alert ("Product was already added"); </script>';
            

        }
    }
    // if cart is empty
    else{
        $product_id = $_POST['product_id'];
        $product_image = $_POST['product_image'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array('product_id' => $product_id, 'product_image' => $product_image, 'product_name' => $product_name, 'product_price' => $product_price, 'product_quantity' => $product_quantity);

        $_SESSION['cart'][$product_id] = $product_array;
    }



//calculatetotal
calculatecart();

}

//Remove the product
else if(isset($_POST['remove_product'])){
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);

    //calculatecart
    calculatecart();
}
else if(isset($_POST['edit_quantity'])){
   
    $product_id = $_POST['product_id'];

    $product_quantity = $_POST['product_quantity'];

    $product_array = $_SESSION['cart'][$product_id];

    $product_array['product_quantity'] = $product_quantity;

    $_SESSION['cart'][$product_id] = $product_array;

    //calculatecart
    calculatecart();
}
else{
    // header("location:index.php");
}
//cart Total

function calculatecart(){
    $total = 0;
    foreach($_SESSION['cart'] as $key=>$value){
        $product = $_SESSION['cart'][$key];
        $price = $product['product_price'];
        $quantity = $product['product_quantity'];
        $total = $total + ($price * $quantity);
    }
    $_SESSION['total'] = $total;
}

function calculateTotalItems($cart) {
  $totalQuantity = 0;
  foreach ($cart as $item) {
      $totalQuantity += $item['product_quantity'];
  }
  return $totalQuantity;
}

$_SESSION['total_items'] = calculateTotalItems($_SESSION['cart']);


?>
<!DOCTYPE html>
<html>
<head>
  <title>Index</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
            .material-icons{
              color:black;
              border-radius: 50px;
              background-color: #fff;
              
            }  
            .material-icons:hover{
                color:red;
                background-color: #fff;
            }

            .update_btn{
            border: 1px solid black;
            padding-left: 10px;
            padding-top: 20px;
            font-size: 12px;
            text-align: center;
            border-radius: 20px;
            color: solid black;
        
            }
            .update_btn:hover{
                background-color:#00A36C;

            }

            .proceed{
              height: 2.4rem;
              padding: 0 1.24em;
              background-color: #04AA6D;
              color: #eef7f6;
              white-space: inherit;
              padding:  9px 10px ;
              border :1px double black;
              border-radius: 2px;
          
              }
     

    .centered {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 20vh;
      padding-bottom: 100px;
      /* background-image: url("Assets/empty_cart.png");       */
    }

            
            

          
  </style>
</head>
<body>
  <!--Header Section-->
  <section id="top">
    <img src="Assets/logo.png" alt="logo">
    <div>
      <ul id="headings">
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="shop.html">Shop</a>
        </li>
        <li>
          <a href="about.html">About Us</a>
        </li>
        <li>
          <a href="contact.html">Contact Us</a>
        </li><!-- <li><a href="login.html"><i style="font-size:24px" class="fa">&#xf007;</i></a></li>
                    <li><a href="cart.html"><i style="font-size:24px" class="fa">&#xf07a;</i></a></li> -->
      </ul>
    </div>
  </section>
  <section id="cart" class="section-p1">
    <table width="100%">
      <thead>
        <tr>
          <td>Remove</td>
          <td>Product</td>
          <td>Description</td>
          <td>Price</td>
          <td>Quantity</td>
          <td>Total</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($_SESSION['cart'] as $key =>$value){ ?>
        <tr>

          <!-- Remove Button -->
          <td>
            <form method="post" action="cart.php">
               <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
             <input type="submit" class="material-icons"  name="remove_product" style="font-size:30px" value="&#xe872" >
            </form>
          </td>
          <td><img src="Assets/<?php echo $value['product_image'];?>" alt=""></td>
          <td><?php echo $value['product_name']; ?></td>
          <td>&#8377; <?php echo $value['product_price']; ?></td>
          <td >
          <form method="POST" action="cart.php">
            
                <input type="number" name="product_quantity" min="1" value="<?php echo $value['product_quantity']; ?>">
                <input type="submit" class="update_btn" value="Update " name="edit_quantity">
                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
           
            </form>
          </td>
          <td>&#8377; <?php echo $value['product_quantity'] * $value['product_price']; ?></td>
        </tr><?php } ?>
      </tbody>
    </table>
  </section><br>
  <br>
  <div class="centered">
    <?php
      // Check if the total items are zero and display message
      if ($_SESSION['total_items'] === 0) {
       
        echo "Your cart is empty";
      }
    ?>
  </div>

  <section id="add2cart" class="section-p1">
    <div id="coupon">
      <h3>Apply Coupon</h3>
      <div>
        <input type="text" placeholder="Enter your coupon"> <button class="normal">Apply</button>
      </div>
    </div>
    <div id="Total">
      <h3>Cart Total</h3>
      <table>
     
        <tr>
          <td><b>Shipping</b></td>
          <td style="color:red;"><b>Free</b></td>
        </tr>
        <tr>
          <td><b>Total</b></td>
          <td>&#8377; <?php echo $_SESSION['total']; ?></td>

          </tr>

          <td><b>Total Items</b></td>
    <td><?php echo "". calculateTotalItems($_SESSION['cart']); ?></td>
</tr>
   
          
        
      </table>
      <form action="checkout.php" method="post">
     <input type="submit" name="checkout" class="proceed" value="PROCEED TO CHECKOUT"></form>
    </div>

  </section>
  
  <!--Subscribe-->

  <form action="email.php" method="post">
    <section id="subscribe">
      <div class="updates">
        <h4><b>Signup for updates</b></h4>
        <p><b>Get updates on Sale and <span>Special offers</span></b></p>
      </div>
      <div class="form">
        <input type="text" name="email" id="emailInput" placeholder="Enter your mail"><button class="normal" style="width: fit-content;">subscribe</button>
      </div>
    </section>
  </form>

  <!-- Footer -->
  <footer class="section-p1">
    <div class="col">
      <img src="Assets/logo.png" alt="logo"><br>
      <h4>Contact Us</h4>
      <p>Address:223 Main Street Electonic City Bengaluru 562107</p>
      <p>Phone:+91 98765 43210</p>
      <p>Email:posh.com</p>
      <div class="follow">
        <h4>Follow Us</h4>
        <div class="col"></div>
      </div>
    </div>
    <div class="col">
      <h4>About</h4><a href="about.html">About Us</a> <a href="#">Privacy Policy</a> <a href="#">Terms & Conditions</a> <a href="contact.html">Contact Us</a>
    </div>
    <div class="col">
      <h4>My Account</h4><a href="login.html">Signin</a> <a href="cart.html">Cart</a> <a href="contact.html">Help</a>
    </div>
    <div class="payment">
    <h4>Secured Payment Gateways</h4><img src="Assets/payment.png" alt="payment"></div>
    <div class="copyright">
      <p>2023 © All Rights Reserved</p>
      <p>Designed and Maintained by <b>Manu</b> and <b>Srisha</b></p>
    </div>
  </footer>
</body>
</html>