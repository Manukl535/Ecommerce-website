
<html><body>
<?php include_once("includes/head.html"); ?>

<?php include_once("includes/headbanner.html"); ?>




            <!--Top Product section-->

                <section id="topproduct" class="section-p1">
                    <h2>Our Popular Products</h2>
                    <p><b>Winter Collection With New Designs</b></p>
                
                <div class="Collection">
                    <?php include('Includes/popular_products.php'); ?>
                    <?php while($row = $popular_products->fetch_assoc()) { ?>
                        <div class="product">
                           <a href="sweat1.html"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                            <div class="description">
                                
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
                    <?php include('Includes/popular_products.php'); ?>
                    <?php while($row = $popular_products->fetch_assoc()) { ?>
                        <div class="product">
                           <a href="sweat1.html"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                           <div class="description">
                                
                                <h5><?php echo $row['product_name']; ?></h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                </div>

                            <h4>&#8377;<?php echo $row['product_price']; ?></h4>
                            </div>

                         
                  
                </div>
                <?php } ?> 
                </section>

                <!--Trending section-->

                <section id="Trending" class="section-p1">
                    <h2>On Trending</h2>
                    <p><b>New Collection With Eligant Designs</b></p>
                
                <div class="Collection2">
                <?php include('Includes/popular_products.php'); ?>
                    <?php while($row = $popular_products->fetch_assoc()) { ?>

                        <div class="product2">
                        <a href="sweat1.html"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
                           <div class="description">
                                
                                <h5><?php echo $row['product_name']; ?></h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                </div>

                            <h4>&#8377;<?php echo $row['product_price']; ?></h4>
                            </div>

                    
                </div>
                <?php } ?>
            </section>

      <!--Buy1 Get 1-->

      <?php include_once("includes/buy1get1.html"); ?> 
      
            
      <!--Subscribe-->
    
        <?php include_once("includes/subscribe.html"); ?> 
        
    
            
      <!-- Footer -->
    
      <?php include_once("includes/footer.html"); ?> 
            
</body>
</html>