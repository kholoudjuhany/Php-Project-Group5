
<?php
include "../connection/connect.php";

// Fetch product details and images

$stmt = $conn->prepare("
    SELECT 
        p.product_id,
        p.pro_name,
        p.pro_desc,
        p.pro_price,
        p.pro_qty,
        p.pro_create_date,
        p.pro_discount,
        p.cat_id,
        c.cat_name,
        pi.pro_image
    FROM 
        products p
    JOIN 
        categories c 
    ON 
        p.cat_id = c.cat_id
    LEFT JOIN 
        product_images pi
    ON 
        p.product_id = pi.product_id
    WHERE 
        p.product_id = :product_id
");

$stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
$product_id =  $_POST["productId"];; // Example product ID
$stmt->execute();
$product = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("product_nav.php") ?>



<body>
    <div class="acontainer">
        <div class="asingle-product">
            <div class="arow">
                <div class="acol-6">
                    <div class="aproduct-image">
                        <div class="aproduct-image-main">
                            <?php if (!empty($product)) { ?>
                                <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($product[0]['pro_image']); ?>" alt="" id="product-main-image">
                            <?php } ?>
                        </div>
                        <div class="aproduct-image-slider">
                            <?php foreach ($product as $img) { ?>
                                <?php if (!empty($img['pro_image'])) { ?>
                                    <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($img['pro_image']); ?>" alt="" class="aimage-list">
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="acol-6">
                    <div class="abreadcrumb">
                        <span><a href="#">Home</a></span>
                        <span><a href="#">Product</a></span>
                        <span class="aactive"><?php echo htmlspecialchars($product[0]['pro_name']); ?></span>
                    </div>

                    <div class="aproduct">
                        <div class="aproduct-title">
                            <h2><?php echo htmlspecialchars($product[0]['pro_name']); ?></h2>
                        </div>
                        <div class="aproduct-rating">
                            <span><i class="bx bxs-star"></i></span>
                            <span><i class="bx bxs-star"></i></span>
                            <span><i class="bx bxs-star"></i></span>
                            <span><i class="bx bxs-star"></i></span>
                            <span><i class="bx bxs-star"></i></span>
                            <span class="review">(47 Reviews)</span>
                        </div>
                        <div class="aproduct-price">
                            <span class="aoffer-price">JOD<?php echo number_format($product[0]['pro_price'], 2); ?></span>
                        </div>

                        <div class="aproduct-details">
                            <h3>Description</h3>
                            <p><?php echo htmlspecialchars($product[0]['pro_desc']); ?></p>
                        </div>
                        <div class="aproduct-size">
                            <!-- Size options will be added here -->
                        </div>
                        <div class="aproduct-color">
                            <!-- Color options will be added here -->
                        </div>
                        <span class="adivider"></span>

                        <div class="aproduct-btn-group">
                            <div class="abutton abuy-now" >
                            <form action="../cart/cart2.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="productId"
                            value="<?php echo htmlspecialchars($product[0]['product_id']); ?>">
                        <p class="product_add-to-cart"><b><button type="submit">Add to cart</button></b></p>
                    </form>
                            </div>
                            <div class="abutton aheart"><i class='bx bxs-heart'></i> Add to Wishlist</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--script-->
    <script src="product_page.js"></script>
    <?php include("../footer/footer.php");?>


