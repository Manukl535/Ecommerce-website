<?php
session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    $product_array_ids = array_column($_SESSION['cart'], "product_id");
    if (!in_array($_POST['product_id'], $product_array_ids)) {
        $product_id = $_POST['product_id'];

        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_image' => $_POST['product_image'],
            'product_name' => htmlspecialchars($_POST['product_name']), // Sanitize the product name
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$product_id] = $product_array;
    } else {
        echo '<script>alert ("Product was already added"); </script>';
    }

    calculatecart();
} elseif (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    calculatecart();
} elseif (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    if (isset($_SESSION['cart'][$product_id])) {
        $product_array = $_SESSION['cart'][$product_id];
        $product_array['product_quantity'] = $product_quantity;
        $_SESSION['cart'][$product_id] = $product_array;
    }

    calculatecart();
}

function calculatecart()
{
    $total = 0;

    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if (isset($_SESSION['cart'][$key]['product_price']) && isset($_SESSION['cart'][$key]['product_quantity'])) {
                $price = $_SESSION['cart'][$key]['product_price'];
                $quantity = $_SESSION['cart'][$key]['product_quantity'];
                $total += ($price * $quantity);
            }
        }
    } else {
        $_SESSION['cart'] = array();
    }

    $_SESSION['total'] = $total;
}

function calculateTotalItems($cart)
{
    $totalQuantity = 0;

    if (isset($cart) && is_array($cart)) {
        foreach ($cart as $item) {
            if (isset($item['product_quantity'])) {
                $totalQuantity += $item['product_quantity'];
            }
        }
    }
    return $totalQuantity;
}

$_SESSION['total_items'] = calculateTotalItems(isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : array());
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <!-- Include your stylesheets and other head elements -->
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
          <a href="shop_1.php">Shop</a>
        </li>
        <li>
          <a href="about.php">About Us</a>
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
  <?php foreach($_SESSION['cart'] as $key => $value) { ?>
    <tr>
      <td>
        <form method="post" action="cart.php">
          <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
          <input type="submit" class="material-icons" name="remove_product" style="font-size:30px" value="&#xe872">
        </form>
      </td>
      <td><img src="Assets/<?php echo $value['product_image']; ?>" alt=""></td>
      <td><?php echo $value['product_name']; ?></td>
      <td>&#8377; <?php echo $value['product_price']; ?></td>
      <td>
        <form method="POST" action="cart.php">
        
        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
    <div class="input-group">
        <input type="number" name="product_quantity" min="1" value="<?php echo $value['product_quantity']; ?>">
        <input type="submit" class="update_btn" value="Update" name="edit_quantity">
    </div>
 
  
</form>
      </td>
      <td>&#8377; <?php echo $value['product_quantity'] * $value['product_price']; ?></td>
    </tr>
  <?php } ?>
</tbody>
    </table>
  </section><br>
  <br>
  <div class="centered">
  
  <?php
  // Check if the total items are zero and display message
  if (!isset($_SESSION['cart']) || empty($_SESSION['cart']) || $_SESSION['total_items'] === 0) {
    echo '<html>
            <body>
            <div style="text-align: center;">
              <img src="Assets/empty_cart.png" alt="Empty Cart Image" style="display: block; margin: 0 auto;">
            </div>
            <br>
            <div style="text-align: center;">
             <h3>Your cart is empty!</h3>
            </div>
            </body>
          </html>';
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
    
  <?php include_once("includes/subscribe.html"); ?> 
        
    
            
        <!-- Footer -->
      
        <?php include_once("includes/footer.html"); ?> 
</body>
</html>
