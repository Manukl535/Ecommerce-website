

<?php include_once("includes/head.php"); ?>

<?php include_once("includes/headbanner.html"); ?>



<html><body>




            <!--Top Product section-->

                <section id="topproduct" class="section-p1">
                    <h2>Our Popular Products</h2>
                    <p><b>Winter Collection With New Designs</b></p>
                
                <div class="Collection">
                    <?php include('Includes/index_products.php'); ?>
                    <?php while($row = $index_men->fetch_assoc()) { ?>
                        <div class="product">
                           
                           <a href="<?php echo "single_product_app.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
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
                    <?php include('Includes/index_products.php'); ?>
                    <?php while($row = $index_women->fetch_assoc()) { ?>
                        <div class="product">
                        <a href="<?php echo "single_product_app.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
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
                    <h2>On Trending</h2>
                    <p><b>New Collection With Eligant Designs</b></p>
                
                <div class="Collection2">
                <?php include('Includes/index_products.php'); ?>
                    <?php while($row = $trending_products->fetch_assoc()) { ?>

                        <div class="product2">
                        <a href="<?php echo "single_product_app.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

      <!--Buy1 Get 1-->

      <?php include_once("includes/buy1get1.html"); ?> 
      
            
      <!--Subscribe-->
    
        <?php include_once("includes/subscribe.html"); ?> 
        
    
            
      <!-- Footer -->
    
      <?php include_once("includes/footer.html"); ?> 
      <?php
// File to store the visitor count
$counterFile = "visitor_count.txt";

// Function to increment the visitor count
function incrementCounter($counterFile) {
    $count = (file_exists($counterFile)) ? (int)file_get_contents($counterFile) : 0;
    $count++;
    file_put_contents($counterFile, $count);
}

// Increment the counter when the page is visited
incrementCounter($counterFile);
?>


<!-- Footer -->

<?php include_once("includes/footer.html"); ?>

<!-- Display the visitor count in the footer -->
<footer>
    <p style="display:none;">Total Visitors: <?php echo (file_exists($counterFile)) ? file_get_contents($counterFile) : 0; ?></p>
</footer>

            
</body>
</html>