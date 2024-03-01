<?php
session_start();

include('Includes/connection.php');

if (!isset($_SESSION['logged-in'])) {
    header('location:login_user.php');
    exit;
}
if (isset($_POST['Change_Password'])) {
    $password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    //pass_confirm pass
    if ($password !== $confirm_password) {
        header('location:account.php?error=Password did not match');
    }
    //length of pass
    elseif (strlen($password) < 6) {
        header('location:account.php?error=Password must have 6 characters');
    //if all correct
    } else {
        $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");

        $stmt->bind_param('ss', $password, $email);

        if ($stmt->execute()) {
            header("location:account.php?message=Password Updated Successfully");
        } else {
            header("location:account.php?error=Couldn't Update the Password");
        }
    }
} elseif (isset($_POST['remove_account'])) {
    $user_id = $_SESSION['user_id'];

    // Delete from the users table
    $stmtUsers = $conn->prepare("DELETE FROM users WHERE user_id=?");
    $stmtUsers->bind_param('i', $user_id);
    $stmtUsers->execute();
    $stmtUsers->close();

    // Delete from the orders table
    $stmtOrders = $conn->prepare("DELETE FROM orders WHERE user_id=?");
    $stmtOrders->bind_param('i', $user_id);
    $stmtOrders->execute();
    $stmtOrders->close();

    // Delete from the order_item table
    $stmtOrderItems = $conn->prepare("DELETE FROM order_item WHERE user_id=?");
    $stmtOrderItems->bind_param('i', $user_id);
    $stmtOrderItems->execute();
    $stmtOrderItems->close();

    // Delete from the return_requests table
    $stmtOrderItems = $conn->prepare("DELETE FROM return_requests WHERE user_id=?");
    $stmtOrderItems->bind_param('i', $user_id);
    $stmtOrderItems->execute();
    $stmtOrderItems->close();

    // Logout the user
    session_unset();
    session_destroy();

    // Add JavaScript to show an alert
    echo "<script>alert('Account has been deleted.');</script>";

    // Redirect to login_user.php with a message
    echo "<script>window.location.href='login_user.php?message=Your account has been removed';</script>";
    exit();
}
else {
    // Fetch orders for the logged-in user
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM order_item WHERE user_id=? ORDER BY order_date DESC");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="Assets/logo2.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
  <title>User Profile</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            
            width: 100%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            
        }
      
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-section {
            margin-bottom: 30px;
        }
        .profile-section h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
              table {
            border-collapse: collapse;
            width: 100%;
          }

          th, td {
        
            text-align: center;
            padding: 8px;
          }

          th {
            background-color: #fff;
            border:1px solid black;
            border-left: none;
            border-right: none;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 8px;
        }
        input[type="password"] {
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px;
            border: none;
            background-color: #4caf50;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        body {
      font-family: Arial, sans-serif;
    }
    .container {
      width: 90%;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      
    }
    .container h2{
      text-align: center;
    }
    input {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
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

  .acct-userbox {
  width: 200px;
  height: 180px;
  background: linear-gradient(to right, #4CAF50, #2196F3);
  margin: 10px;
  padding: 10px;
  text-align: center;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 30px;
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
  transform: scale(1.02); /* Adjust scale for 3D effect */
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
                    <li>
                        <div class="dropdown">
                          
                            <div class="dropbtn">
                              <div><a>Men's</a></div> 
                          
                        </div>   
                          <div class="dropdown-content">
                            <a href="men_app_1.php">Apperal</a>
                            
                            <a href="men_foot_1.php">Footwear</a>
                            <a href="men_acc_1.php">Accessories</a>
                          </div>
                        
                        
                      </li>
                      <li>
                        <div class="dropdown">
                          
                            <div class="dropbtn">
                              <div><a>Women's</a></div> 
                          
                        </div>   
                          <div class="dropdown-content">
                            <a href="women_app_1.php">Apperal</a>
                            <a href="women_foot_1.php">Footwear</a>
                            <a href="women_acc_1.php">Accessories</a>
                          </div>
                        
                        
                      </li>
                   
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
                          <div class="dropdown-content">
                            <a href="account.php"><img src="Assets/dashboard.png">&nbsp;Dashboard</a>
                            <a href="logout.php"><i style="font-size:24px" class="fa">&#xf08b;</i>Logout</a>
                          </div>
                        
                        
                      </li>
    <li> <a href="cart.php" style="position: relative;">
        <i style="font-size:24px" class="fa">&#xf07a; </i> Cart
        <?php
        // Check if the total items are greater than 0 and display the quantity
        if (isset($_SESSION['total_items']) && $_SESSION['total_items'] > 0) {
            echo '<span style="font-size: 10px; color: white; background:red; position: absolute; bottom: 18px; right: 32px; border: 1px solid #ccc; border-radius: 80%; padding: 3px 8px;">' . $_SESSION['total_items'] . '</span>';
        }
        ?>
    </a>
</li>
                   <!-- <input type="text" class="search-input" placeholder="Search..."><button class="search-btn">Search</button>
                    -->
                </ul>
            
            </div>

             
</section>

              <div class="acct-links-container" style="display: flex;justify-content: center;">
    <div class="acct-userbox">
      <p><img src="Assets/user_icon.png" alt="user_icon"></p>
      <p>Hello, <b><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; } ?></b></p>
   
    </div>
  </div>
  <div class="container" style="display: flex;">
        <div class="profile-section" style="flex: 1;">
            <!-- User info -->
            <div class="container" style="height: 55vh;">
                <center>
                    <h3>Personal Information</h3>
                </center>

            <div id="userInfoDisplay">
              <p><label for="email">Name: <?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; } ?></label></p>
              <p><label for="email">Email: <?php if(isset($_SESSION['email'])){echo $_SESSION['email']; } ?></label> </p> 
              <p><label for="phone">Phone: <?php if(isset($_SESSION['phone'])){echo $_SESSION['phone']; } ?></label></p>
            </div>


            <form action="account.php" method="post" onsubmit="return confirmDeleteAccount();">

    <center>
        <br><br><br>
        <button type="submit" name="remove_account" style='background-color: #f44336; border-radius: 50px;'>Remove My Account</button>
    </center>
</form>
            </div>
        </div>
    <script>
  function confirmDeleteAccount() {
    // Display a confirmation dialog
    var confirmDelete = confirm("Are you sure you want to delete your account?\nOnce account deleted can't be recovered");

    // If the user clicks 'OK', the form will be submitted
    return confirmDelete;
  }
</script>
        <div class="profile-section" style="flex: 1;">
            <!-- Change password -->
            <div class="container" style="height: 55vh;">
                <center>
                    <h3>Change Password</h3>
                    <p style="color:red;"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                    <p style="color:green;"><?php if (isset($_GET['message'])) { echo $_GET['message']; } ?></p>
                </center>
                <form id="account-form" action="account.php" method="POST">
                    <label for="new_password">New Password</label> <input type="password" id="new_password"
                        name="new_password" required="">
                    <label for="confirm_password">Confirm New Password</label> <input type="password"
                        id="confirm_password" name="confirm_password" required="">
                    <center>
                        <button type="submit" name="Change_Password" style='border-radius: 50px;'>Change Password</button>
                    </center>
                </form>
                <script>
                    // Add JavaScript to scroll to the changePassword section
                    if (window.location.hash === '#changePassword') {
                        document.getElementById('account-form').style.display = 'block';
                    }
                </script>
            </div>
        </div>
    </div>
<br/><br/>
    
<style
>button {
        cursor: pointer;
        display: inline-block;
        padding: 12px 24px;
        font-size: 16px;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #ffffff;
        background-color: #3498db;
        border: none;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.3s;
    }

    button:hover {
        background-color: #45a049;
        transform: scale(1.05);
    }
   
    .order-box {
        border: 1px solid #ddd;
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .order-box table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-box th, .order-box td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
        font-size: 14px;
    }

    .order-box th {
        background-color: #f2f2f2;
        font-weight: bold;
        color: #333;
    }

    .order-box tr:hover {
        background-color: #f5f5f5;
    }

    .orders-heading {
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
    }

    .orders-heading::after {
        content: "";
        display: block;
        width: 40px; 
        height: 3px; 
        background-color: #FF9933; 
        position: absolute;
        bottom: -183px; 
        left: 50%;
        transform: translateX(-50%);
    }

</style>


<div class="profile-section" id="changePassword">
    <section id="cart" class="section-p1">
        <h4 class="orders-heading">Your Orders</h4><br/><br>
        <div class="order-box">
            <table>
                <tr>
                   
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Order Cost</th>
                    <th>Order Details</th>
                    <th>Invoice</th>
                    
                </tr>

                <?php
                    while ($row = $orders->fetch_assoc()) {?>
                    <tr>
                        
    
    <td>ODR<?php echo str_pad($row['order_id'], 3, '0', STR_PAD_LEFT); ?></td>
    <td><?php echo date('d-m-Y', strtotime($row['order_date'])); ?></td>

    <?php
    $dod = $row['dod'];
    $formatted_date = date('d-m-Y', strtotime($dod));
    $isDelivered = strtotime($dod) <= strtotime(date('Y-m-d'));
    $statusText = $isDelivered ? 'Delivered On' : 'Delivery On';
    $statusColor = $isDelivered ? 'green' : 'black';
    ?>

    <td style="color: <?php echo $statusColor; ?>"><strong><?php echo $statusText . ': ' . $formatted_date; ?></strong></td>

    <td>&#8377; <?php echo $row['product_price']; ?></td>

    <td>
        <form method="GET" action="orders_details.php">
            <input type="hidden" value="<?php echo $row['product_id']; ?>" name="product_id">
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
            <button <?php if ($isDelivered) echo 'enabled'; else echo 'disabled'; ?> style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 90%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px;" type="submit" name="orders_btn">
                Order Details
            </button>
        </form>
    </td>

    <td>
        <form method="GET" action="invoice.php">
            
            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
            <button style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 90%; height: 7vh; color: black; font-weight: bold; border: 1px solid black; border-radius: 50px;" type="submit" name="invoice_btn">
                <i class="fa fa-print"></i> Invoice
            </button>
        </form>
    </td>
</tr>

                <?php } ?>

            </table>
        </div>

        <script>
            function redirectToInvoice(orderId) {
                window.location.href = "invoice.php?order_id=" + orderId;
            }
        </script>

        <?php
        if ($orders->num_rows > 0) {
            // Display orders if available
        } else {
            // Display a message when there are no orders
            echo "<div style='text-align: center; padding-top: 20px;'>
            <p style='font-weight: 500; font-weight: bold; color: red;'>Order history is empty!</p>
            <img src='Assets/no_orders.png' alt='Empty Order History Image' style='width: 150px; height: 150px;'><br/>
            <a href='shop_1.php'><button style='background-color: rgb(81, 182, 81); text-decoration: none; font-size: 12px; width: 10%;  color: black; font-weight: bold; border: 1px solid black; border-radius: 50px;'>Order Now!</button></a>
          </div>";
        }
        ?>
    </section>
</div>

</body>
</html>