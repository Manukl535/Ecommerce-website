<?php
session_start();

include('Includes/connection.php');

if(!isset($_SESSION['logged-in'])){
  header('location:login_user.php');
  exit;
}
if(isset($_POST['Change_Password'])){
  $password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];
  $email = $_SESSION['email'];
 

  //pass_confirm pass
  if($password !== $confirm_password){
    header('location:account.php?error=Password did not match');
    
  }
  //length of pass
  else if(strlen($password) < 6){
    header('location:account.php?error=Password must have 6 characters');
  //if all correct
  }
  else{
    $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");

    $stmt->bind_param('ss',$password,$email);

    if($stmt->execute()){
      header("location:account.php?message=Password Updated Successfully");
    }
    else{
      header("location:account.php?error=Couldn't Update the Password");
    }
  }
}

//get orders
if(isset($_SESSION['logged-in'])){
    
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");

    $stmt->bind_param('i',$user_id);

    $stmt->execute();

    $orders = $stmt->get_result();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

  </style>
</head>
<body>
  <section id="top">
    <img src="Assets/logo.png" alt="logo">
    <div>
      <ul id="headings">
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="shop.php">Shop</a>
        </li>
        <li>
          <a href="about.php">About Us</a>
        </li>
        <li>
          <a href="contact.html">Contact Us</a>
        </li><!-- <li><a href="login.php"><i style="font-size:24px" class="fa">&#xf007;</i></a></li>-->
        <li>
          <a href="cart.php"><i style="font-size:24px" class="fa"></i></a>
        </li>
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
      <div class="container">
        <center>
          <h3>Personal Information</h3><button onclick="toggleEdit()">Edit</button>
        </center>
        <form id="userInfoForm" style="display: none;" name="userInfoForm">

          <label for="name">Name:</label> <input type="text" id="name" name="name" value="<?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; } ?>" required=""> 
          <label for="email">Email:</label> <input type="text" id="email" name="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email']; } ?>" required="">
           <label for="phone">Phone:</label> <input type="text" id="phone" name="phone" pattern="[0-9]*" pattern="[0-9]*" value="<?php if(isset($_SESSION['phone'])){echo $_SESSION['phone']; } ?>" required="">
           
          <center>
            <button type="submit">Save Changes</button>
          </center>
        </form>
        <div id="userInfoDisplay">
          <input type="text" id="name" name="name" value="<?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name']; } ?>" readonly> 
          <label for="email">Email:</label> <input type="text" id="email" name="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email']; } ?>" readonly>  
          <label for="phone">Phone:</label> <input type="text" id="phone" name="phone" pattern="[0-9]*" value="<?php if(isset($_SESSION['phone'])){echo $_SESSION['phone']; } ?>" readonly>
        </div>
        <form action="account.php" method="post">
          <center>
            <button type="submit" style="background-color: #f44336;">Remove My Account</button>
          </center>
        </form>
      </div>
    </div>
    <script>
            function toggleEdit() {
              var form = document.getElementById('userInfoForm');
              var display = document.getElementById('userInfoDisplay');
              var editButton = document.querySelector('button');
              
              if (form.style.display === 'none') {
                form.style.display = 'block';
                display.style.display = 'none';
                editButton.textContent = 'Cancel';
              } else {
                form.style.display = 'none';
                display.style.display = 'block';
                editButton.textContent = 'Edit';
              }
            }
    </script>
   
    <div class="profile-section" style="flex: 1;">
      <!-- Change password -->
      <div class="container" style="height: 58vh;">
        <center>
          <h3>Change Password</h3>
          <p style="color:red;"><?php if(isset($_GET['error'])) { echo $_GET['error']; } ?></p>
          <p style="color:green;"><?php if(isset($_GET['message'])) { echo $_GET['message']; } ?></p>
        </center>
        <form id="account-form" action="account.php" method="POST">
          <label for="new_password">New Password</label> <input type="password" id="new_password" name="new_password" required=""> 
          <label for="confirm_password">Confirm New Password</label> <input type="password" id="confirm_password" name="confirm_password" required="">
          <center>
            <button type="submit" name="Change_Password">Change Password</button>
          </center>
        </form>
      </div>
    </div>
    </div>
    <div class="profile-section">
      <section id="cart" class="section-p1">
        <h4 style="text-align: center;">Your Orders</h4><br>
        <table>
          <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Order Staus</th>
            <th>Order Cost</th>
            <th>Order Quantity</th>
            <th>Order Details</th>
          </tr>
          <?php while($row = $orders->fetch_assoc() ){ ?>
          <tr>
          <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['order_date']; ?></td>
            <td><?php echo $row['order_status']; ?></td>
            <td>&#8377; <?php echo $row['order_cost']; ?></td>
            <td><?php echo $row['order_quantity']; ?></td>

            <form method="GET" action="invoice.php">
              <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id">
            <td><button style="background-color: rgb(81, 182, 81); text-decoration: none; font-weight: 30px; width: 50%; height: 7vh;color: black;font-weight:bold;border: 1px solid black;border-radius: 50px;"  name="invoice_btn">Invoice</button></td>
            </tr>
          </form>
          <?php } ?>
        </table>
        <!-- <script>
          onclick="navigateToPage()"
              function navigateToPage() {
                // Replace 'page-url' with the actual URL of the page you want to navigate to
                window.location.href = 'invoice.php';
              }
        </script> -->
      </section>
    </div>
 
</body>
</html>