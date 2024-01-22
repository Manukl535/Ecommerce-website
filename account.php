<?php
session_start();

if(!isset($_SESSION['logged-in'])){
  header('location:login_user.php');
  exit;
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles.css">
  <title></title>
  <style>

    
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
  margin: 0 0 0 10px;
  
}

.dropdown:hover .dropdown-content {
  display:block;
  
  
  
}

.dropbtn::before {
    
  content: "";
  position: absolute;
  top: 60%;
  right: 10px;
  transform: translateY(-50%);
  /* border: solid #000; */
  border-width: 0 2px 2px 0;
  display: inline-block;
  padding: 3px;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  
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

#myModal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 20px;
        }
        .modal-content  {
            display: flex; /* Use flexbox */
            align-items: center; /* Center items vertically */
        }

         .modal-content img  {
            max-width: 100%; /* Ensure the image doesn't exceed its container */
            border :1px double pink;
            border-radius: 13px;
        }

         .newsletter  {
            flex: 1; /* Fill remaining space */
            padding: 0 20px; /* Add some padding */
        }
        .newsletter h3{
         text-align: center;
         }

         .newsletter input{
         height: 3rem;
         padding: 0 1.24em;
         width: 60%;
         border :1px double black;
        font-size: 14px;
        border-radius: 4px;
        outline: none;
        }
        .newsletter  button{
        height: 3rem;
        padding: 0 1.24em;
        background-color: #04AA6D;
        color: #eef7f6;
        white-space: inherit;
        padding:  13px;
        border :1px double black;
        width: 30%;
        border-radius: 4px;
      }
       .close {
            position:left;
            top:10px;
            right: 10px;
            padding-bottom: 300px;
            padding-left: 500px;
            font-size: 30px;
            cursor: pointer;
          }

 .search-container {
  position: relative;
  display: inline-block;
}

.search-input {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 20px;
  outline: none;

}
.search-btn{
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 20px;
  outline: none;
  color: #04AA6D;
  background-color: #eef7f6;
}

    .container {
    display: flex;
  }

  .user-container {
    display: flex;
    align-items: center; 
  }

  user-icon {
    margin-right: 20px; 
  }

  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    
  }

  .acct-userbox {
  width: 200px;
  height: 180px; 
  background-color: white;
  margin: 10px;
  padding: 10px;
  text-align: center;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  
}

  .acct-box {
    width: 200.5px;
    background-color: white;
    margin: 10px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .acct-box p {
    font-size: 18px;
    margin: 5px 0; /* Adjust the margin to reduce line spacing */
  }

  .acct-links-container a {
    text-decoration: none; 
    color: inherit;
    display: block; 
    margin-bottom: 10px; 
  }

  iframe {
    flex: 1; 
    height: 80vh;
    border: beige;
    border-radius: 20px; 
  }


</style>
</head>

<body>
      <!--Header Section-->

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
                    <a href="mens_app.html">Apperal</a>
                    
                    <a href="mens_foot.html">Footwear</a>
                    <a href="mens_acc.html">Accessories</a>
                  </div>
                
                
              </li>
              <li>
                <div class="dropdown">
                  
                    <div class="dropbtn">
                      <div><a>Women's</a></div> 
                  
                </div>   
                  <div class="dropdown-content">
                    <a href="mens_app.html">Apperal</a>
                    <a href="mens_foot.html">Footwear</a>
                    <a href="mens_acc.html">Accessories</a>
                  </div>
                
                
              </li>
           
            <li><a href="about.php">About Us</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li>
                <div class="dropdown">
                  <a href="login_user.php">
                    <div class="dropbtn">
                      <div class="test" ><i style="font-size:20px" class="fa" >&#xf2be;&nbsp;</i>Login&nbsp;&#11167;</div> 
                  </a>
                </div>   
                  <div class="dropdown-content">
                    <a href="account.php"><img src="Assets/dashboard.png">&nbsp;Dashboard</a>
                    <a href="logout.php"><i style="font-size:24px" class="fa">&#xf08b;</i>Logout</a>
                  </div>
                
                
              </li>
            <li><a href="cart.php"><i style="font-size:24px" class="fa">&#xf07a; </i> Cart</a></li>
           <input type="text" class="search-input" placeholder="Search..."><button class="search-btn">Search</button>
           
        </ul>
    
    </div>

     
</section>
<br/>

  
 
<div class="acct-links-container" style="display: flex;">
  <div class="acct-userbox">
    <p><img src="Assets/user_icon.png"></p>
   
    <p>Hello, <b><?php echo $_SESSION['user_name']; ?></b></p>

  </div>
  <div class="acct-links-container" style="display: flex; flex-direction: column;">
    <a href="orders.html" target="content">
      <div class="acct-box">
        My Orders
      </div>
    </a>
    <a href="account_set.html" target="content">
      <div class="acct-box">
        Account Settings
      </div>
    </a>
    <a href="Personal_info.html" target="content">
      <div class="acct-box">
        Personal Information
      </div>
    </a>
  </div>
  <iframe name="content" style="width: 60%; margin-left: 20px;" id="content" src="Personal_info.html"></iframe>
</div>
<!-- <br/><br/>
<form action="email.php" method="post">
    <section id = "subscribe">
        
        <div class="updates">
        <h4><b>Signup for updates</b></h4>
        <p><b>Get updates on Sale and <span>Special offers</span></b></p>
        </div>
    
        <div class="form">
            <input type="text" name="email" id="emailInput" placeholder="Enter your mail"/><button class="normal" style="width: fit-content;" >subscribe</button>
        </div>
          
    </form>
    </section>
<footer class="section-p1">
    <div class="col">
        <img src="Assets/logo.png"><br/>
        <h4>Contact Us</h4>
        <p>Address:223 Main Street Electonic City Bengaluru 562107</p>
        <p>Phone:+91 98765 43210</p>
        <p>Email:posh.com</p>
        <div class="follow">
            <h4>Follow Us</h4>
            <div class="col">
                <ul>
                <i class="fa fa-facebook-official" style="font-size:36px"></i>
                <i class="fa fa-instagram" style="font-size:36px"></i>
                <i class="fa fa-twitter-square" style="font-size:36px"></i>
            </ul>
            </div>
        </div>
    </div>
    
    <div class="col">
        <h4>About </h4>
        <a href="about.php">About Us</a>
        <a href="T&C.html">Privacy Policy</a>
        <a href="T&C.html">Terms & Conditions</a>
        <a href="contact.html">Contact Us</a>
    </div>
    <div class="col">
        <h4>My Account</h4>
        <a href="login.html">Signin</a>
        <a href="cart.php">Cart</a>
        <a href="contact.html">Help</a>
    </div>
    <div class="payment">
            <h4>Secured Payment Gateways</h4>
        <img src="Assets/payment.png">
    </div>
    <div class="copyright">
        <p>2023 &#169; All Rights Reserved</p><p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
    </div>


   </footer>
    
  -->
</body>
</html>