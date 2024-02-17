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

 <section id="top">
        <img src="Assets/logo.png">
    
    <div>
        <ul id="headings">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop_1.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <!-- <li><a href="login.html"><i style="font-size:24px" class="fa">&#xf007;</i></a></li>-->
            <li><a href="cart.php"><i style="font-size:24px" class="fa">&#xf07a;</i> Cart </a></li>
        </ul>
    </div>
    
     </section>







               <!--Sandals-->

               <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/men_up.php'); ?>
                      <?php while($row = $sandals->fetch_assoc()) { ?>
                          <div class="product">
                             
                             <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                              <div class="description">
                              <span>Posh</span>
                                  <h5><?php echo $row['product_name']; ?></h5>
  
                                  <div class="rating">
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                  </div>
  
                              <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                              </div>
  
                           
                    
                  </div>
                  <?php } ?> 
                  </section>
  
                  <!-- Shoes -->
  
                  <section id="topproduct" class="section-p1">
                    
                  
                    <div class="Collection">
                        <?php include('Includes/men_up.php'); ?>
                        <?php while($row = $crocks->fetch_assoc()) { ?>
                            <div class="product">
                               
                               <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                                <div class="description">
                                <span>Posh</span>
                                    <h5><?php echo $row['product_name']; ?></h5>
    
                                    <div class="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                    </div>
    
                                <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                                </div>
    
                             
                      
                    </div>
                    <?php } ?> 
                    </section>
    
            <!--Sandals-->

            <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/men_up.php'); ?>
                      <?php while($row = $sneakers->fetch_assoc()) { ?>
                          <div class="product">
                             
                             <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                              <div class="description">
                              <span>Posh</span>
                                  <h5><?php echo $row['product_name']; ?></h5>
  
                                  <div class="rating">
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                  </div>
  
                              <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                              </div>
  
                           
                    
                  </div>
                  <?php } ?> 
                  </section>
  
                  <!-- Shoes -->
  
                  <section id="topproduct" class="section-p1">
                    
                  
                    <div class="Collection">
                        <?php include('Includes/men_up.php'); ?>
                        <?php while($row = $formal_shoes->fetch_assoc()) { ?>
                            <div class="product">
                               
                               <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                                <div class="description">
                                <span>Posh</span>
                                    <h5><?php echo $row['product_name']; ?></h5>
    
                                    <div class="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                    </div>
    
                                <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                                </div>
    
                             
                      
                    </div>
                    <?php } ?> 
                    </section>
    
           
            <!--Sandals-->

            <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/women_up.php'); ?>
                      <?php while($row = $sandals->fetch_assoc()) { ?>
                          <div class="product">
                             
                             <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                              <div class="description">
                              <span>Posh</span>
                                  <h5><?php echo $row['product_name']; ?></h5>
  
                                  <div class="rating">
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                  </div>
  
                              <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                              </div>
  
                           
                    
                  </div>
                  <?php } ?> 
                  </section>
  
                  <!-- Shoes -->
  
                  <section id="topproduct" class="section-p1">
                    
                  
                    <div class="Collection">
                        <?php include('Includes/women_up.php'); ?>
                        <?php while($row = $shoes->fetch_assoc()) { ?>
                            <div class="product">
                               
                               <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                                <div class="description">
                                <span>Posh</span>
                                    <h5><?php echo $row['product_name']; ?></h5>
    
                                    <div class="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                    </div>
    
                                <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                                </div>
    
                             
                      
                    </div>
                    <?php } ?> 
                    </section>
<!--Flats-->

<section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/women_up.php'); ?>
                      <?php while($row = $flats->fetch_assoc()) { ?>
                          <div class="product">
                             
                             <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                              <div class="description">
                              <span>Posh</span>
                                  <h5><?php echo $row['product_name']; ?></h5>
  
                                  <div class="rating">
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                          <span class="fa fa-star checked"></span>
                                  </div>
  
                              <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                              </div>
  
                           
                    
                  </div>
                  <?php } ?> 
                  </section>
  
                  <!-- Boots -->
  
                  <section id="topproduct" class="section-p1">
                    
                  
                    <div class="Collection">
                        <?php include('Includes/women_up.php'); ?>
                        <?php while($row = $boots->fetch_assoc()) { ?>
                            <div class="product">
                               
                               <a href="<?php echo "single_product_foot.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                                <div class="description">
                                <span>Posh</span>
                                    <h5><?php echo $row['product_name']; ?></h5>
    
                                    <div class="rating">
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                    </div>
    
                                <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                                </div>
    
                             
                      
                    </div>
                    <?php } ?> 
                    </section>
    
                    
     <!--Subscribe-->
    
        <?php include_once("includes/subscribe.html"); ?> 
        
    
            
      <!-- Footer -->
    
      <?php include_once("includes/footer.html"); ?> 
            
</body>
</html>