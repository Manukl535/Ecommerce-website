<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">

    <style>
        /* Add your styles here if needed */
    </style>
</head>
<body>
    <!-- Header Section -->
    <?php include_once("includes/head.php"); ?>

    <!-- T-Shirts -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/men_up.php'); ?>
            <?php while($row = $men_up2->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_app.php?product_id=".$row['product_id']; ?>">
                        <img src="Assets/<?php echo $row['product_image']; ?>">
                    </a>
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
        </div>
    </section>

    <!-- Polo T-Shirts -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/men_up.php'); ?>
            <?php while($row = $men_up3->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_app.php?product_id=".$row['product_id']; ?>">
                        <img src="Assets/<?php echo $row['product_image']; ?>">
                    </a>
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
        </div>
    </section>

    <!-- Subscribe -->
    <?php include_once("includes/subscribe.html"); ?>

    <!-- Footer -->
    <?php include_once("includes/footer.html"); ?>
</body>
</html>
