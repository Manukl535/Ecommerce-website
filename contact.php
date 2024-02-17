<html>
    <head>
        <title>Contact</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="Assets/logo2.png">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>

        <!-- Header Section -->
        <?php include_once("includes/head.php"); ?>

        <section id="contact_us" class="contact">
            <h2>#let's_meet</h2>
            <p>We are happy to hear from you...</p>
        </section>
        <br><br></br/>

        <section id="contact" class="contact_us">
            <div class="">              
                <h4>Meet Us</h4> <br/> 
                <h5>Head Office:</h5>
                <p>Address: 223 Main Street Electronic City Bengaluru 562107</p>
                <p>Phone: +91 98765 43210</p>
                <p>Email: posh.com</p>
            </div>
            </div>
            
               <div id="map" style="width:50%; height: 300px;"></div>
                
                <script>
                    function myMap() {
                      var mapCanvas = document.getElementById("map");
                      var mapOptions = {
                        center: new google.maps.LatLng(12.840711, 77.676369), zoom: 10
                      };
                      var map = new google.maps.Map(mapCanvas, mapOptions);
                    }
                 </script>
                    
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCCIRoC23VBrHHRJbgQosiK-SfHLm74JWQ&callback=myMap"></script>

        </section>
        <br/>
        <p>&nbsp;&nbsp;<b>Leave a Message</b></p>
        <style>
            textarea {
                width: 40%;
                height: 150px;
                padding: 10px 20px;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                background-color: #f8f8f8;
                font-size: 16px;
                resize: none;  
            }
          
            .center {
                padding: 0 20px 70px 220px;   
            }
            
            input {
                background-color: #04AA6D;
                /* Green */
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                border-radius: 50px;
            }
        </style>
        
        <form action="submit_feedback.php" method="post">
            <p>&nbsp; 
                <textarea id="feedback" name="feedback" rows="4" cols="50" required="required"></textarea>
            </p>
            <div class="center">
                <p><input type="submit" style="width: fit-content;" value="SUBMIT"></p>
            </div>
        </form>

        <!-- Footer -->
        <footer class="section-p1">
            <div class="copyright">
                <p>2023 &#169; All Rights Reserved</p>
                <p>Designed and Maintained by <b>Manu</b> and <b>Srisha</b></p>
            </div>
        </footer>           
    </body>
</html>
