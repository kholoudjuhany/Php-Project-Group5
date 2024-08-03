<?php
$cat_id=0;
if(isset($_POST["cat_ID"]) && $_SERVER["REQUEST_METHOD"] == "POST")
{
    $cat_id = $_POST["cat_ID"];
}
$Allproducts = $conn->prepare("SELECT p.product_id, p.pro_name,  p.pro_price, p.cat_id, pi.pro_image
    FROM Products p
    JOIN Product_Images pi ON p.product_id = pi.product_id
    WHERE p.cat_ID = $cat_id
    GROUP BY p.product_id
    HAVING COUNT(pi.pro_image_id) = 1;
");


$Allproducts->execute();
$products = $Allproducts->fetchAll(PDO::FETCH_ASSOC);


if(empty($products)){
    $Allproducts = $conn->prepare("SELECT p.product_id, p.pro_name,  p.pro_price, p.cat_id, pi.pro_image
    FROM Products p
    JOIN Product_Images pi ON p.product_id = pi.product_id
    WHERE p.cat_ID = 7
    GROUP BY p.product_id
    HAVING COUNT(pi.pro_image_id) = 1;
");

$Allproducts->execute();
$products = $Allproducts->fetchAll(PDO::FETCH_ASSOC);

}
?>

<section class="category_products_page">

    <div class="category_products_page_cards">
        <?php foreach ($products as $product): ?>
            
                <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                
                    <div class="product_card">
                    <form action="../productPage/product.php" method="post" style="display: inline-block;">
                    <button type="submit" style="border: none;">
                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($product['pro_image']); ?>" alt="product image" />
                        </button>
                        </form>
                        <div class="product_card_content">
                            <p class="product_card_content-name"><b><?php echo htmlspecialchars($product['pro_name']); ?></b></p>
                            <p class="product_card_content-price"><?php echo htmlspecialchars($product['pro_price']); ?> JOD</p>
                            <p class="product_add-to-cart"><b>Add to cart</b></p>
                        </div>
                    </div>
                
            
        <?php endforeach; ?>
    </div>
</section>