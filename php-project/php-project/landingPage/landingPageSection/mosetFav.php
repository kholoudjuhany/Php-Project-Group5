<?php
// Fetch most favorite products with only one image per product
$stmt_most_fav = $conn->prepare("
    SELECT 
        products.product_id, 
        products.pro_name, 
        products.pro_price, 
        MIN(product_images.pro_image) AS pro_image,  
        COUNT(favs.product_id) AS fav_count
    FROM 
        products
    JOIN 
        favs ON products.product_id = favs.product_id
    JOIN 
        product_images ON products.product_id = product_images.product_id
    GROUP BY 
        products.product_id, 
        products.pro_name, 
        products.pro_price
    ORDER BY 
        fav_count DESC
    LIMIT 6
");
$stmt_most_fav->execute();
$products = $stmt_most_fav->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="favorite_section">
    <h1>Most Favorite</h1>
    <h6>Explore our most favorite products</h6>
    <div class="favorite_section_cards">
        <?php foreach ($products as $product): ?>



            <div class="fav_card">
                <form action="../productPage/product.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                    <button type="submit" style="border: none;">
                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($product['pro_image']); ?>"
                            alt="" />
                    </button>
                </form>
                <div class="card-content">
                    <p class="product-name"><b><?php echo htmlspecialchars($product['pro_name']); ?></b></p>
                    <p class="price"><?php echo htmlspecialchars($product['pro_price']); ?> JOD</p>
                    <form action="../cart/cart2.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="productId"
                            value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <p class="add-to-cart"><button type="submit"><b>Add to cart</b></button></p>
                    </form>
                </div>
            </div>


        <?php endforeach; ?>
    </div>
</section>