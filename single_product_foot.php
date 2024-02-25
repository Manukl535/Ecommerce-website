<?php 
include('Includes/connection.php');
if(isset($_GET['product_id'])){
  
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param("i",$product_id);

    $stmt->execute();

    $product = $stmt->get_result();

}else{
  header('location:index.php');
}

?>
<html>
<head>
    <title>Shoping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        /* Add your styles here */
    </style> 
</head>
<body>
    <?php include_once("includes/head.php"); ?>

    <section id="productdetails" class="section-p1">
        <div class="product1">
            <div class="img-zoom-container">
                <?php while($row = $product->fetch_assoc()){ ?>
                    <form method="POST" action="cart.php" id="addToCartForm">
                        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?> "/>
                        <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?> "/>
                        <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?> "/>
                        <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?> "/>
                        <input type="hidden" name="selected_size" id="selectedSize" value=""/>
                        <div class="img-magnifier-container">
                            <img id="myimage" src="Assets/<?php echo $row['product_image']; ?>" width="300" height="411">
                        </div>
                    </div>
                </div>
                <div class="pro1">
                    <h4><?php echo $row['product_name']; ?></h4><br/>
                    <div class="rating">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star-half-o checked"></span>
                    </div>
                    <h3>&#8377;<?php echo $row['product_price']; ?></h3><br/>
                    <div class="color-swatches">
                        <div class="swatch" style="background-color: blue" onclick="selectColor('blue')"></div>
                        <div class="swatch" style="background-color: red" onclick="selectColor('red')"></div>
                        <div class="swatch" style="background-color: gray" onclick="selectColor('gray')"></div>
                    </div>
                    <br/>
                    <select required="required" onchange="enableAddToCartButton(this)">
                        <option>Select Size</option>
                        <option value="S">6 UK</option>
                        <option value="M">7 UK</option>
                        <option value="L">8 UK</option>
                        <option value="XL">9 UK</option>
                        <option value="XL">10 UK</option>
                    </select>
                    <input type="number" min="1" name="product_quantity" value="1">
                    <button class="normal" type="submit" name="add_to_cart" disabled>Add To Cart</button>
                    <br/><br/>
                    <h4>Product Description</h4><?php echo $row['product_description']; ?>
                </div>
                <?php } ?>
            </form>
        </section>

        <center><strong>This Product is subjected to <a href="Includes/cancellation_policy.html"  style="text-decoration: none; color: inherit;">No Cancellation Policy</a></strong>

            <script>
                function selectColor(color) {
                    // Handle color selection logic 
                }

                function enableAddToCartButton(sizeSelect) {
                    var addToCartButton = document.querySelector('.pro1 button');
                    var selectedSize = sizeSelect.value;
                    var selectedSizeInput = document.getElementById('selectedSize');
                    selectedSizeInput.value = selectedSize;

                    if (selectedSize !== 'Select Size') {
                        addToCartButton.removeAttribute('disabled');
                    } else {
                        addToCartButton.setAttribute('disabled', 'disabled');
                    }
                }
            </script>
        </body>
        </html>
