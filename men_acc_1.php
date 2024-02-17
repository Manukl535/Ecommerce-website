<html>
<head>
    <title>Men's</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>


    </style> 

</head>
<body>
 <!--Header Section-->

 <?php include_once("includes/head.php"); ?>







            <!--Sunglass-->

                <section id="topproduct" class="section-p1">
                  
                
                <div class="Collection">
                    <?php include('Includes/men_up.php'); ?>
                    <?php while($row = $sunglass->fetch_assoc()) { ?>
                        <div class="product">
                           
                           <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

                <!-- Shirts -->
                        
                <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/men_up.php'); ?>
                      <?php while($row = $watch->fetch_assoc()) { ?>
                          <div class="product">
                             
                             <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"> <img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

                 
             <!-- Pagination -->
             <div class="pagination">
            <a href="men_acc_1.php">&laquo;</a>
            <a class="active" href="men_acc_1.php">1</a>
            <a class="" href="men_acc_2.php">2</a>
            <a href="#"> . . .</a>
            
            <a href="men_acc_2.php">&raquo;</a>
          </div>
          <br/>


     <!--Subscribe-->
    
        <?php include_once("includes/subscribe.html"); ?> 
        
    
            
      <!-- Footer -->
    
      <?php include_once("includes/footer.html"); ?> 
            
</body>
</html>