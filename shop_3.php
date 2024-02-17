<html>
<head>
    <title>Shoping</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <link rel="stylesheet" href="styles.css">

    <style>
        
    </style> 
</head>
<body>
    <!-- Header Section -->
    <?php include_once("includes/head.php"); ?>

    <style>
        .container {
            display: flex;
            justify-content: center;
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
        }

        .box a {
            text-decoration: none; 
            color: #fff; 
            font-weight: bold;
        } 
    </style>

    <div class="container">
        <div class="box" id="box1"><a href="shop_1.php">Apperals</a></div>
        <div class="box" id="box2"><a href="shop_2.php">Footwears</a></div>
        <div class="box" id="box3"><a href="shop_3.php">Accessories</a></div>
    </div>

    <!-- Sunglasses Section -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/men_up.php'); ?>
            <?php while($row = $sunglass->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Sunglasses for Women -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/women_up.php'); ?>
            <?php while($row = $sunglass->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Hat Section -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/men_up.php'); ?>
            <?php while($row = $hat->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Hat for Women -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/women_up.php'); ?>
            <?php while($row = $hat->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Wallet Section -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/men_up.php'); ?>
            <?php while($row = $wallet->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Bag Section -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/women_up.php'); ?>
            <?php while($row = $bag->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Watch Section -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/men_up.php'); ?>
            <?php while($row = $watch->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Shirts Section -->
    <section id="topproduct" class="section-p1">
        <div class="Collection">
            <?php include('Includes/women_up.php'); ?>
            <?php while($row = $watch->fetch_assoc()) { ?>
                <div class="product">
                    <a href="<?php echo "single_product_acc.php?product_id=".$row['product_id']; ?>"><img src="Assets/<?php echo $row['product_image']; ?>"></a>
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

    <!-- Pagination -->
    <div class="pagination">
        <a href="shop_2.php">&laquo;</a>
        <a class="" href="shop_1.php">1</a>
        <a class="active" href="shop_2.php">2</a>
        <a href="shop_2.php">3</a>
        <a href="shop_1.php">&raquo;</a>
    </div>
    <br/>

    <!-- Subscribe -->
    <?php include_once("includes/subscribe.html"); ?> 

    <!-- Footer -->
    <?php include_once("includes/footer.html"); ?> 
</body>
</html>
