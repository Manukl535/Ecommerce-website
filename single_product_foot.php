<?php 
include('Includes/connection.php');

if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();

} else {
    header('location:index.php');
}

?>
<html>
<head>
    <title>Shopping</title>
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
            <?php while($row = $product->fetch_assoc()){ ?>
            <form method="POST" action="cart.php" id="addToCartForm" onsubmit="return validateForm()">
                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
                <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
                <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
                <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
                <input type="hidden" name="selected_size" id="selectedSize" value=""/>
                <input type="hidden" name="available_qty" value="<?php echo $row['available_qty']; ?>"/> <!-- Retrieve available_qty -->

                <div>
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
            <?php
                $priceDisplay = '&#8377;' . $row['product_price'];
                if ($row['available_qty'] == 0) {
                    $priceDisplay = 'Sold Out';
                } else if ($row['available_qty'] < 6) {
                    $priceDisplay .= ' <span style="color: red;">(' . $row['available_qty'] . ' stocks left)</span>';
                }
            ?>
            <h3><?php echo $priceDisplay; ?></h3><br/>
            <div class="color-swatches">
                        <div class="swatch" style="background-color: blue" onclick="selectColor('blue')"></div>
                        <div class="swatch" style="background-color: red" onclick="selectColor('red')"></div>
                        <div class="swatch" style="background-color: gray" onclick="selectColor('gray')"></div>
                    </div>
                    <br/>
                
                <select required="required" id="sizeSelect">
                    <option>Select Size</option>
                    <option value="6">6 UK</option>
                    <option value="7">7 UK</option>
                    <option value="8">8 UK</option>
                    <option value="9">9 UK</option>
                    <option value="10">10 UK</option>
                </select>

            <?php
                if ($row['available_qty'] == 0) {
                    echo '<button class="disabled" type="button" disabled>Add To Cart</button>';
                } else {
            ?>
               
          <input type="number" min="1" max="<?php echo $row['available_qty'] ; ?>" name="product_quantity" value="1" oninput="validateQuantity(this)">

<script>
    function validateQuantity(input) {
        var enteredQty = parseInt(input.value);
        var maxQty = parseInt(input.getAttribute('max'));

        if (enteredQty > maxQty) {
            alert("Quantity not available");
            input.value = maxQty; // Set the input value to the maximum allowed quantity
        }
    }
</script>
 <button class="normal" type="submit" name="add_to_cart">Add To Cart</button>
            <?php } ?>
            <br/><br/>
            <h4>Product Description</h4><?php echo $row['product_description']; ?>
        </div>
        <?php } ?>
    </form>
</section>

<center><strong>This Product is subjected to <a href="Includes/cancellation_policy.html"  style="text-decoration: none; color: inherit;">No Cancellation Policy</a></strong></center>

<script>
    function selectColor(color) {
        // Handle color selection logic 
    }

    function validateForm() {
        var sizeSelect = document.getElementById('sizeSelect');
        var selectedSize = sizeSelect.value;

        if (selectedSize === 'Select Size') {
            alert("Please select the size");
            return false; // Prevent form submission if size is not selected
        }

        document.getElementById('selectedSize').value = selectedSize;
        return true; // Allow form submission if size is selected
    }
</script>
</body>
</html>
