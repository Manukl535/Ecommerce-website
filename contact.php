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
       
        <style>
             body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px 10px auto;
    
    padding: 20px;
    
    text-align: left; 
}


h2 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    margin-bottom: 5px;
}

input, textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    background-color: #4CAF50;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    width: 20%;
    font-weight:700;
}


button:hover {
    background-color: #45a049;
}

.center{
    text-align:center;
}
        </style>
        
<div class="container">
<h4>Leave us a Message</h4><br/>
    <form action="submit_feedback.php" method="post">
        <div class="form-group">
            <label for="name"> Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email"> Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="email"> Phone:</label>
            <input type="phone" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="feedback"> Feedback:</label>
            <textarea id="feedback" name="message" rows="4" required style="resize:none;"></textarea>
    </div>
        
    <div class="center"><button type="submit" name="feedback">Submit</button></div>
        
    </form>
</div>

  <!-- Footer -->
        <footer class="section-p1">
            <div class="copyright">
                <p>2023 &#169; All Rights Reserved</p>
                <p>Designed and Maintained by <b>Manu</b> and <b>Srisha</b></p>
            </div>
        </footer>           
    </body>
</html>
