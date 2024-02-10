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







            <!--Top Product section-->

                <section id="topproduct" class="section-p1">
                  
                
                <div class="Collection">
                    <?php include('Includes/index_men.php'); ?>
                    <?php while($row = $index_men->fetch_assoc()) { ?>
                        <div class="product">
                           
                           <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

                <section id="topproduct" class="section-p1">
                    
                
                <div class="Collection">
                    <?php include('Includes/index_women.php'); ?>
                    <?php while($row = $index_women->fetch_assoc()) { ?>
                        <div class="product">
                        <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                           <div class="description">
                                
                           <span>Posh</span>
                                <h5><?php echo $row['product_name']; ?></h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star-half-o checked"></span>
                                </div>

                            <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                            </div>

                         
                  
                </div>
                <?php } ?> 
                </section>

                <!--Trending section-->

                <section id="Trending" class="section-p1">
                    
                
                <div class="Collection2">
                <?php include('Includes/trending_products.php'); ?>
                    <?php while($row = $trending_products->fetch_assoc()) { ?>

                        <div class="product2">
                        <a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                           <div class="description">
                                <span>Posh</span>
                                <h5><?php echo $row['product_name']; ?></h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star-half-o checked"></span>
                                </div>

                            <h4>&#8377; <?php echo $row['product_price']; ?></h4>
                            </div>

                    
                </div>
                <?php } ?>
            </section>
              <!-- Pagination -->
              <div class="pagination">
            <a href="shop_1.php">&laquo;</a>
            <a class="active" href="shop_1.php">1</a>
            <a class="" href="shop_2.php">2</a>
            <a href="#"> . . .</a>
            
            <a href="Shop_2.php">&raquo;</a>
          </div>
          <br/>


     <!--Subscribe-->
    
        <?php include_once("includes/subscribe.html"); ?> 
        
    
            
      <!-- Footer -->
    
      <?php include_once("includes/footer.html"); ?> 
            
</body>
</html>