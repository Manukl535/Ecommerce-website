<html>
<head>
    <title>Shoping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>


    </style> 
 <script>
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollIntoView({ behavior: 'smooth' });

             
        }
    </script>
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
     <style>
     .container {
  display: flex;
  justify-content:center;
  /* top:0;
  z-index: 100;
  position:sticky; */

}

.box {
  flex: 0.2; 
  height: 40px;
  margin: 10px;
  text-align: center;
  line-height: 40px;
  background-color: #f2f2f2;
  border: 1px solid #ccc;
  border-radius: 50px; 
  background-image: linear-gradient(to right, rgba(255,0,0,0), rgba(255,0,0,1));
  color: #fff;
  font-weight:bold;
}

.box a{
    text-decoration: none; 
    color: #fff; 
    font-weight:bold;
} 

</style>
     

   
<div class="container" >
  <div class="box" id="box1" onclick="scrollToSection('section1')"><a href='#'>Apperals</a></div>
  <div class="box" id="box2" onclick="scrollToSection('section2')"><a href='#'>Footwears</a></div>
  <div class="box" id="box3" onclick="scrollToSection('section3')"><a href='#'>Accessories</a></div>
</div>


<section id="section1">

        <center><h1>Apperals</h1></center>


            <!--Top Product section-->

                <section id="topproduct" class="section-p1">
                  
                
                <div class="Collection">
                    <?php include('Includes/women_up.php'); ?>
                    <?php while($row = $women_up->fetch_assoc()) { ?>
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


                <!--Trending section-->

                <section id="Trending" class="section-p1">
                    
                
                <div class="Collection2">
                <?php include('Includes/women_up.php'); ?>
                    <?php while($row = $frocks->fetch_assoc()) { ?>

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
            
            <!-- tshirts -->

            <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/women_up.php'); ?>
                      <?php while($row = $sweater->fetch_assoc()) { ?>
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

                  <!-- polo_tshirts -->
                  
                  <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/men_up.php'); ?>
                      <?php while($row = $croptop->fetch_assoc()) { ?>
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
                      <?php include('Includes/women_up.php'); ?>
                      <?php while($row = $onepiece->fetch_assoc()) { ?>
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
                      </section>

                      <section id="section2">
                  <center><h1>Footwears</h1></center>
                  <!-- Shoes -->
  
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
    
            <!--Sandals-->

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
  
                  <!-- Shoes -->
  
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
                      </section>

                      <section id="section3">

                  <center><h1>Accessories</h1></center>

            <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/women_up.php'); ?>
                      <?php while($row = $hat->fetch_assoc()) { ?>
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
                        <?php include('Includes/women_up.php'); ?>
                        <?php while($row = $bag->fetch_assoc()) { ?>
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
                      <?php include('Includes/women_up.php'); ?>
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

                  <section id="topproduct" class="section-p1">
                  
                
                  <div class="Collection">
                      <?php include('Includes/women_up.php'); ?>
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
                      </section>
                   
               
     <!--Subscribe-->
    
        <?php include_once("includes/subscribe.html"); ?> 
        
    
            
      <!-- Footer -->
    
      <?php include_once("includes/footer.html"); ?> 
            
</body>
</html>
