<html>
    <head>
        <title>About</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="Assets/logo2.png">
        <link rel="stylesheet" href="styles.css">

    </head>
    <body>

        
             <!--Header Section-->

             <?php include_once("includes/head.php"); ?>


            
             <section id ="aboutus_header" class="about">
             </section>
             <br><br></br/>

             <section id="header" class="about_section">
                <img src="Assets/aboutus.jpg">     
                <div>
                    <h2>Who are we?</h2>
                    <p><span>
                            Posh is a clothing boutique for men and women. 
                            We bring together a unique collection of the best brands, latest fashions, and signature finds to help you
                             define and express your unique style,each garment is a signature of our sartorial elegance.
                            <p>Available in ready-to-wear, made-to-measure and bespoke options, our garments are made for individuals that appreciate superior quality and craftsmanship.We've been styling for over twenty years and have three storefronts </p>
                        </span>
                    </p>
                    
                    <marquee scrollamount="5" width="100%" direction="right">
                        <strong>Thank you for choosing our ecommerce website</strong></marquee>
                        
                        
                </div>

             </section>
             <br><br><br/>

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
             
 
            
        <!-- Footer -->
      
        <?php include_once("includes/footer.html"); ?> 
    
    </body>
</html>