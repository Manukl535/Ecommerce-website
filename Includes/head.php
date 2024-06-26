<?php
session_start();
?>
<html>
    <head>
        <title>Index</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="Assets/logo2.png">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link rel="stylesheet" href="styles.css">
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



</style>

</head>

    <body>
        
      <div id="myModal" class="modal" style="display: none;">
        <div class="modal-content">
          <img src="Assets/popup.jpg" alt="subscribe newsletter" width="400" height="300">
          <div class="newsletter">
            <span class="close">&times;</span>
            <form action="email.php" method="post">
              <h3 class="newsletter-title">Subscribe Our Newsletter.</h3>
              <p>Subscribe the <b>Posh</b> to get latest products and discounts update.</p>
              <input type="email" name="email" class="email-field" placeholder="Email Address" required>
              <button type="submit" class="btn-newsletter">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
      
      <!-- Add the modal HTML structure to your HTML file -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <p>This is your modal content.</p>
  </div>
</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Check if the modal should be displayed
function displayModal() {
  // Check if the modal has been displayed before
  var modalCount = localStorage.getItem('modalCount') || 0;

  if (modalCount < 2) {
    modal.style.display = "block";
    localStorage.setItem('modalCount', ++modalCount); // Increment the count and update localStorage
  }
}

// Call the displayModal function after 1 seconds (1000 milliseconds)
setTimeout(displayModal, 1000);

// Close the modal when the user clicks on the close button
var closeBtn = document.querySelector(".close");
closeBtn.onclick = function() {
  modal.style.display = "none";
}
</script>

               
        
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

            