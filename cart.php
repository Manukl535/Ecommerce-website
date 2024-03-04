<?php
session_start();
include('Includes/connection.php');
// Check if 'cart' is set in $_SESSION
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (isset($_POST['add_to_cart'])) {
    // Check if the cart is set and is an array
    if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $product_array_ids = array_column($_SESSION['cart'], "product_id");
    if (!in_array($_POST['product_id'], $product_array_ids)) {
        $product_id = $_POST['product_id'];

        $product_array = array(
            'product_id' => $_POST['product_id'],
            'product_image' => $_POST['product_image'],
            'product_name' => htmlspecialchars($_POST['product_name']), 
            'product_price' => $_POST['product_price'],
            'product_quantity' => $_POST['product_quantity']
        );

        $_SESSION['cart'][$product_id] = $product_array;
    } else {
        echo '<script>alert ("Product was already added"); </script>';
    }

    // Calculate total
    calculatecart();
} elseif (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    // Check if the cart is set and is an array
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    // Calculate total
    calculatecart();
} elseif (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    // Fetch available quantity from the database using your function
    $available_qty = getAvailableQuantity($product_id);

    // Check if the cart is set and is an array
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) {
        // Check if the entered quantity is less than or equal to available_qty
        if ($product_quantity <= $available_qty) {
            $product_array = $_SESSION['cart'][$product_id];
            $product_array['product_quantity'] = $product_quantity;
            $_SESSION['cart'][$product_id] = $product_array;

            // Calculate total
            calculatecart();
        } else {
            echo '<script>alert("Sorry, Requested quantity not available!");</script>';
        }
    }
}
 else {
    // header("location:index.php");
}

// Cart Total
function calculatecart()
{
    $total = 0;

    // Check if the cart is set and is an array
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if (isset($value['product_price']) && isset($value['product_quantity'])) {
                $price = $value['product_price'];
                $quantity = $value['product_quantity'];
                $total += ($price * $quantity);
            }
        }
    } else {
        // If $_SESSION['cart'] is not set or not an array, initialize it as an empty array
        $_SESSION['cart'] = array();
    }

    $_SESSION['total'] = $total;
}

function calculateTotalItems($cart)
{
    $totalQuantity = 0;

    // Check if the cart is set and is an array
    if (isset($cart) && is_array($cart)) {
        foreach ($cart as $item) {
            if (isset($item['product_quantity'])) {
                $totalQuantity += $item['product_quantity'];
            }
        }
    }
    return $totalQuantity;
}

// Function to get available quantity from the database (replace this with your actual function)
function getAvailableQuantity($product_id) {
    // Assuming you have a database connection
    global $conn;

    $stmt = $conn->prepare("SELECT available_qty FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($available_quantity);
    $stmt->fetch();
    $stmt->close();

    return $available_quantity;
}

// Initialize total_items even if 'cart' is not set or not an array
$_SESSION['total_items'] = calculateTotalItems(isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : array());
?>

<!DOCTYPE html>
<html>
<head>
    <title>Index</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="Assets/logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="styles.css">
    <style>
        .material-icons{
            color:black;
            border-radius: 50px;
            background-color: #fff;
            border:none;
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
            color: #fff;
            background-color: #55c2da;
            font-weight: bold;
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
        }

        tr > td:nth-child(5) {
            padding-left:155px; 
        }

        .input-group {
            display: flex;
            align-items: center;
        }

        .input-group input {
            margin: -90px;
        }

        .dropdown {
  position: relative;
  display: inline-block;
  padding-bottom: 3px;
  
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
  z-index: 1;
  margin: 0 0 0 0;
  transform: perspective(1px) translateZ(0); 
  transform-origin: 0 0;
  transition: transform 0.3s ease-in-out; 
  border: 1px solid #ccc; 
  border-radius: 5px; 
}

.dropdown:hover .dropdown-content {
  display: block;
  transform: scale(1.02); 
}

.dropbtn::before {
  content: "";
  position: absolute;
  top: 60%;
  right: 10px;
  transform: translateY(-50%);
  border-width: 0 2px 2px 0;
  display: inline-block;
  padding: 3px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  transition: background-color 0.3s ease-in-out; /* Add transition effect */
  border-top: 1px solid #ccc; /* Add border between items */
}

.dropdown-content a:first-child {
  border-top: none; /* Remove border for the first item */
}

.dropdown-content a:hover {
  background-color: #f1f1f1;
}
.test{
    padding-bottom: 2px;
    border: 1px solid #fff;
    padding: 10px; 
    border-radius: 25px;
    
    
    
}
.test:hover{
    background-color:green;
    border-radius: 25px; 
    color: #fff;
}

  </style>
</head>
<body>

  <!-- Header Section -->
<section id="top">
                <img src="Assets/logo.png">
                                 
            <div>
               
                <ul id="headings">
               
                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop_1.php">Shop</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li>
    <div class="dropdown">
        <a href="login_user.php">
            <div class="dropbtn">
                <div class="test">
                    <i style="font-size:20px" class="fa">&#xf2be;&nbsp;</i>
                    <?php 
                        if(isset($_SESSION['user_name'])) {
                            $formattedName = ucfirst(strtolower($_SESSION['user_name']));
                            echo '<span style="font-size: 15.6px;">' . $formattedName . '</span>'; 
                        } else {
                            echo 'Login';
                        }
                    ?>
                    &nbsp;&#11167;
                </div>
            </a>
        </div>   
        <?php
            // Check if the user is logged in
            if(isset($_SESSION['user_name'])) {
                // User is logged in, display dropdown content
        ?>
            <div class="dropdown-content">
                <a href="account.php"><img src="Assets/dashboard.png">&nbsp;Dashboard</a>
                <a href="logout.php"><i style="font-size:24px" class="fa">&#xf08b;</i>Logout</a>
            </div>
        <?php
            }
        ?>
    </li>

</div>
 </a>
                        </div>   
                          <div class="dropdown-content">
                            <a href="account.php"><img src="Assets/dashboard.png">&nbsp;Dashboard</a>
                            <a href="logout.php"><i style="font-size:24px" class="fa">&#xf08b;</i>Logout</a>
                          </div>
                        
                        
                      </li>
 
                   <!-- <input type="text" class="search-input" placeholder="Search..."><button class="search-btn">Search</button>
                    -->
                </ul>
            
            </div>

             
</section>

<?php if (!empty($_SESSION['cart'])) { ?>     
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
                <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                    <tr>
                        <td>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                                <input type="submit" class="material-icons" name="remove_product" style="font-size:30px" value="&#xe872">
                            </form>
                        </td>
                        <td><img src="Assets/<?php echo $value['product_image']; ?>" alt=""></td>
                        <td><?php echo htmlspecialchars($value['product_name']); ?></td>
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
    </section>
    <?php }?>
    

    <div class="centered" style="padding: 200px;;">
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
    // Set total to 0
    $_SESSION['total'] = 0;
        }
        ?>
    </div>
    <?php if (isset($_SESSION['total']) && $_SESSION['total'] > 0) { ?>
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
                    <?php
                        // Check if the total items are greater than 0 before changing the color
                        if (isset($_SESSION['total_items']) && $_SESSION['total_items'] > 0) {
                            echo '<td style="color:red;"><b>Free</b></td>';
                        } else {
                            echo '<td><b></b></td>';
                        }
                        ?>
                </tr>

                <tr>
                    <td><b>Total</b></td>
                    <?php
                    // Check if the total items are greater than 0 before displaying the total amount
                    if (isset($_SESSION['total_items']) && $_SESSION['total_items'] > 0) {
                        echo '<td>&#8377; ' . (isset($_SESSION['total']) ? $_SESSION['total'] : 0) . '</td>';
                    } else {
                        echo '<td></td>'; // or you can add any placeholder content here if you don't want to show anything
                    }
                    ?> 
                </tr>

                <tr>
                    <td><b>Total Items</b></td>
                    <?php
                        // Check if the total items are greater than 0 before displaying the total items
                        if (isset($_SESSION['total_items']) && $_SESSION['total_items'] > 0) {
                            echo '<td>' . calculateTotalItems($_SESSION['cart']) . '</td>';
                        } else {
                            echo '<td></td>'; // or you can add any placeholder content here if you don't want to show anything
                        }
                        ?>
                </tr>
            </table>

            <?php
                    // Check if the total items are greater than 0 before displaying the "Proceed to Checkout" button
                    if (isset($_SESSION['total_items']) && $_SESSION['total_items'] > 0) {
                        echo '<form action="checkout.php" method="post">
                                <input type="submit" name="checkout" class="proceed" value="PROCEED TO CHECKOUT">
                            </form>';
                    } else {
                        echo '<button class="proceed" disabled>PROCEED TO CHECKOUT</button>';
                    }
                    ?>
            
        </div>
    </section>
<?php }?>
</body>
</html>
