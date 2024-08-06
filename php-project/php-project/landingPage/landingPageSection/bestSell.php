<?php

// Prepare and execute the SQL statement
$stmt_best = $conn->prepare("SELECT p.product_id, p.pro_name, p.pro_price, pi.pro_image
    FROM products p
    JOIN (
        SELECT product_id, pro_image
        FROM product_images
        WHERE product_id = (
            SELECT product_id
            FROM favs
            GROUP BY product_id
            ORDER BY COUNT(fav_id) DESC
            LIMIT 1
        )
        -- LIMIT 1  -- Ensure only one image is selected
    ) pi ON p.product_id = pi.product_id
");

$stmt_best->execute();
$best_pro = $stmt_best->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="best_seller_section">
    <h1>Bestsellers</h1>
    <h6>Explore our most popular products</h6>
    <div class="best_seller_cards">
        <?php foreach ($best_pro as $pro): ?>
            <div class="card">
                <form action="../productPage/product.php" method="post" style="display: inline-block;">
                    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($pro['product_id']); ?>">
                    <button type="submit" style="border: none;">
                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($pro['pro_image']); ?>" alt="<?php echo htmlspecialchars($pro['pro_name']); ?>" />
                    </button>
                </form>
                <div class="card-content">
                    <p class="product-name"><b><?php echo htmlspecialchars($pro['pro_name']); ?></b></p>
                    <p class="price"><?php echo htmlspecialchars($pro['pro_price']); ?> JOD</p>
                    <form action="../cart/cart2.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($pro['product_id']); ?>">
                        <p class="add-to-cart"><button type="submit" class="toggle-cart-btn"><b>Add to cart</b></button></p>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
