<?php 
include('Includes/connection.php');
if(isset($_GET['product_id'])){
  
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param("i",$product_id);

    $stmt->execute();

    $product = $stmt->get_result();

}else{
  header('location:index.php');
}

?>
<html>
<head>
    <title>Shoping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>


    </style> 

</head>
<body>
     <!--Header Section-->

     <?php include_once("includes/head.php"); ?>

     <section id="productdetails" class="section-p1">
      
      <div class="product1">
        <div class="img-zoom-container">
          <?php while($row = $product->fetch_assoc()){ ?>
            <form method="POST" action="cart.php">
              
              <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?> "/>
              <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?> "/>
              <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?> "/>
              <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?> "/>
          
          <div class="img-magnifier-container">
            <img id="myimage" src="Assets/<?php echo $row['product_image']; ?>" width="300" height="400">
          </div>
          
    
  </div>
  </div>




       <div class="pro1">
     
                               
        <h4><?php echo $row['product_name']; ?></h4><br/>
        <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star-half-o checked"></span>
                                </div>
        <h3>&#8377;<?php echo $row['product_price']; ?></h3><br/>

        <div class="color-swatches">
          <div class="swatch" style="background-color: blue" onclick="selectColor('blue')"></div>
          <div class="swatch" style="background-color: red" onclick="selectColor('red')"></div>
          <div class="swatch" style="background-color: gray" onclick="selectColor('gray')"></div>
      </div>
      <br/>
      
        <select required="required">
          <option>Select Size</option>
          <option>S</option>
          <option>M</option>
          <option>L</option>
          <option>XL</option>
        </select>
        <input type="number" min="1" name="product_quantity" value="1">
        <button class="normal" onclick="addToCart()" type="submit" name="add_to_cart">ADD TO CART</button>
        <br/><br/>
        <h4>Product Description</h4><?php echo $row['product_description']; ?>
        
      </div>
      </form>
        <?php } ?>
    </section>
    <br><br><br><br>
    <script>
      


 
    function addToCart() {
  var selectedSize = document.querySelector('select').value;
  if (selectedSize === 'Select Size') {
    alert('Please select a size before adding to cart');
  } else {
    var productDescription = document.querySelector('.pro1 h4').textContent;
    var productPrice = document.querySelector('.pro1 h3').textContent;
    var productImage = document.querySelector('.product1 img').src;

    // Now you have the product description, price, image, and size
    // You can use this information to add the item to the cart or display it to the user
    console.log("Description: " + productDescription);
    console.log("Price: " + productPrice);
    console.log("Size: " + selectedSize);
    console.log("Image: " + productImage);
  }
}
      </script>
    
 <!--Subscribe-->
    
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
                <a href="about.html">About Us</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="contact.html">Contact Us</a>
            </div>
            <div class="col">
                <h4>My Account</h4>
                <a href="#">Signin</a>
                <a href="cart.html">Cart</a>
                <a href="#">Help</a>
            </div>
            <div class="payment">
                <h4>Secured Payment Gateways</h4>
                <img src="Assets/payment.png">
            </div>
            <div class="copyright">
                <p>2023 &#169; All Rights Reserved</p><p>Designed and Maintained by <b>Manu </b>and <b>Srisha</b></p>
            </div>
    
           </footer> 
</body>
</html>