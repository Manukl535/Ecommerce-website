

<html>
    <head>
        <title>Index</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

</style>

</head>
    <body>
        

        <!-- <div id="myModal" class="modal">
            <div class=" modal-content ">
                
                <img src="Assets/popup.jpg" alt="subscribe newsletter" width="400" height="300">
                <div class=" newsletter "><span class="close">&times;</span>
                    <form action="email.php" method="post">  
                        <h3 class="newsletter-title">Subscribe Our Newsletter.</h3>
                        <p>Subscribe the <b>Posh</b> to get latest products and discount update.</p>
                        <input type="email" name="email" class=" email-field " placeholder="Email Address" required>
                        <button type="submit" class=" btn-newsletter ">Subscribe</button>
                    </form>
                </div>
            </div>
        </div> -->
        
         
           
     
    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // When the page is fully loaded
        window.onload = function() {
            // Display the modal
            modal.style.display = "block";
        }

        // Close the modal when the user clicks on the close button
        var closeBtn = document.querySelector(".close");
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    </script>
        
               
        
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
                   
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact Us</a></li>
                    <li>
                        <div class="dropdown">
                          <a href="login.html">
                            <div class="dropbtn">
                              <div class="test" ><i style="font-size:20px" class="fa" >&#xf2be;&nbsp;</i>Login&nbsp;&#11167;</div> 
                          </a>
                        </div>   
                          <div class="dropdown-content">
                            <a href="#"><img src="Assets/dashboard.png">&nbsp;Dashboard</a>
                            <a href="logout.html"><i style="font-size:24px" class="fa">&#xf08b;</i>Logout</a>
                          </div>
                        
                        
                      </li>
                    <li><a href="cart.html"><i style="font-size:24px" class="fa">&#xf07a; </i> Cart</a></li>
                </ul>
            
            </div>
             </section>

             
             
             <section id="banner">
                <img src="Assets/sale.gif">
                <h2>50-80%<sub>off on </sub></h2>
                <h2>all products</h2>
                <h4>Save More Shop More..!</h4>
                <a href="shop.html"><button style="font-size:20px;width: fit-content;" ><i style="color: gold" class="fa fa-bolt"></i> <b>Shop Now</b></button></a>
              </section>



                <section id="fashion" class="section-m1" >

                    <div class="fashicon1" >
                       
                       
                        <h3>Men's Fashion</h3><a href="#"><h5>SHOP NOW</h5></a>
                   </div>
   
                   
                   <div class="fashicon2" class="section-m1">

                       
                       <h3>Women's Fashion</h3><a href="#"><h5>SHOP NOW</h5></a>
                   </div> 
                   
                   <div class="fashicon3" class="section-m1">

                       
                       <h3>Accessories</h3><a href="#"><h5>SHOP NOW</h5></a>
                   </div>                 
           
                   </section>

                
             <center><h3>Our Services</h3></center>
            <section id="services" class="section-p1">
                
                <div class="servicon">
                    <div class="image-zoom">
                       <a href="shipping.html"> <img src="Assets/ship.png" width="70%" class="zoom-img"></a>
                      </div>
                    </div>
                <div class="servicon">
                    <div class="image-zoom">
                        <a href="online.html"> <img src="Assets/online.png" width="70%" class="zoom-img"></a>
                       </div>
                     </div>
                <div class="servicon">
                    <div class="image-zoom">
                        <a href="specoff.html"> <img src="Assets/specoff.png" width="70%" class="zoom-img"></a>
                       </div>
                     </div>
                <div class="servicon"> 
                    <div class="image-zoom">
                        <a href="custservice.html"> <img src="Assets/24X7.png" width="70%" class="zoom-img"></a>
                       </div>
                     </div>
                
            </section>

            <!--Top Product section-->

                <section id="topproduct" class="section-p1">
                    <h2>Our Popular Products</h2>
                    <p><b>Winter Collection With New Designs</b></p>
                
                <div class="Collection">
                        <div class="product">
                           <a href="sweat1.html"> <img src="Assets/sweat1.png"></a>
                            <div class="description">
                                <span>Posh</span>
                                <h5>Men Blue Relaxed Hoodie</h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                </div>

                            <h4>&#8377; 2,499 </h4>
                            </div>

                         
                    </div>
                    <div class="product">
                        <a href="sweat2.html"> <img src="Assets/sweat2.png"></a>
                        <div class="description">
                            <span>Posh</span>
                            <h5>Men Blue Relaxed Hoodie</h5>

                            <div class="rating">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                            </div>

                        <h4>&#8377; 1,499 </h4>
                        </div>

                     
                </div>

                <div class="product">
                    <a href="sweat1.html"> <img src="Assets/sweat3.png"></a>
                    <div class="description">
                        <span>Posh</span>
                        <h5>Men Blue Relaxed Hoodie</h5>

                        <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                        </div>

                    <h4>&#8377; 3,429 </h4>
                    </div>

                 
            </div>


            <div class="product">
                <a href="sweat1.html"> <img src="Assets/sweat4.png"></a>
                <div class="description">
                    <span>Posh</span>
                    <h5>Men Blue Relaxed Hoodie</h5>

                    <div class="rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                    </div>

                <h4>&#8377; 8,999 </h4>
                </div>

             
        </div>

           
                </div>
                </section>

                <section id="topproduct" class="section-p1">
                    
                
                <div class="Collection">
                        <div class="product">
                            <a href="sweat1.html"> <img src="Assets/women1.png"></a>
                            <div class="description">
                                <span>Posh</span>
                                <h5>Women's Oversized Hoodie</h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                </div>

                            <h4>&#8377; 5,342 </h4>
                            </div>

                         
                    </div>
                    <div class="product">
                        <a href="sweat1.html"> <img src="Assets/women2.png "></a>
                        <div class="description">
                            <span>Posh</span>
                            <h5>Women's Lavendor Relaxed Hoodie</h5>

                            <div class="rating">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                            </div>

                        <h4>&#8377; 2,456 </h4>
                        </div>

                     
                </div>

                <div class="product">
                    <a href="sweat1.html"> <img src="Assets/women3.png"></a>
                    <div class="description">
                        <span>Posh</span>
                        <h5>Women's White Hoodie </h5>
    
                        <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                        </div>
    
                    <h4>&#8377; 3,267 </h4>
                    </div>
    
                 
            </div>
    
            

            <div class="product">
                <a href="sweat1.html"> <img src="Assets/women4.png"></a>
                <div class="description">

                    <span>Posh</span>
                    <h5>Women's Printed Pullover</h5>

                    <div class="rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                    </div>

                <h4>&#8377; 3,267 </h4>
                </div>

             
        </div>

        
                </div>
                </section>

                <!--Trending section-->

                <section id="Trending" class="section-p1">
                    <h2>On Trending</h2>
                    <p><b>New Collection With Eligant Designs</b></p>
                
                <div class="Collection2">
                        <div class="product2">
                            <a href="sweat1.html"> <img src="Assets/shirt1.png"></a>
                            <div class="description">
                                <span>Posh</span>
                                <h5>Men Black Printed Casual Shirt</h5>

                                <div class="rating">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                </div>

                            <h4>&#8377; 1,499 </h4>
                            </div>

                         
                    </div>

                    <div class="product2">
                        <a href="sweat1.html"> <img src="Assets/shirt2.png"></a>
                        <div class="description">
                            <span>Posh</span>
                            <h5>Men White Printed Casual Shirt</h5>

                            <div class="rating">
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                                    <span class="fa fa-star checked"></span>
                            </div>

                        <h4>&#8377; 2,799 </h4>
                        </div>

                     
                </div>

                <div class="product2">
                    <a href="sweat1.html"> <img src="Assets/shirt3.png"></a>
                    <div class="description">
                        <span>Posh</span>
                        <h5>Men Pink Printed Casual Shirt</h5>

                        <div class="rating">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                        </div>

                    <h4>&#8377; 1,799 </h4>
                    </div>

                 
            </div>

            <div class="product2">
                <a href="sweat1.html"> <img src="Assets/shirt4.png"></a></a>
                <div class="description">
                    <span>Posh</span>
                    <h5>Men Graphic Printed Casual Shirt</h5>

                    <div class="rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                    </div>

                <h4>&#8377; 1,999 </h4>
                </div>

            
        </div>
                    
                </div>
            </section>

            <!--Buy1 Get 1-->
            <section id="buy1get1" class="section-p1">
                
                <div class="buy1get1_box">
                    <h4><b>Special Deals</b></h4>
                    <h3>Buy 1 Get 1 Free</h3>
                    <a href="#"><button>Explore More</button></a>
                </div>    
            
                <div class="buy1get1_box1">
                    
                    <h4>Upcoming Sale</h4>                    
                    <h3>Get Ready..</h3>
                    <a href="#"><button>Collection</button></a>
                </div>

             </section>
                          
             
                <section id="buy1get1" class="section-m1" >

                 <div class="buy1get1_box2" >
                    
                    <a href="#"><h4><center><b>T Shirts</b></center></h4></a>
                        
                </div>

                
                <div class="buy1get1_box3" class="section-m1">
                    <a href="#"> <h4><center><b>Sungalsses</b></center></h4> 
                     </a>
                </div> 
                
                <div class="buy1get1_box4" class="section-m1">
                    <a href="#">
                    <h4><b>Footwares</b></h4></a> 
                    <h3></h3>
                    
                </div>                 
        
                </section><br><br/>
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
        
    
            
      <!-- Footer -->
       

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
                <a href="login.html">Signin</a>
                <a href="cart.html">Cart</a>
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
            
         
            
</body>
</html>