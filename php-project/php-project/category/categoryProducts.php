<?php
include("../connection/connect.php");

$cat_id = isset($_POST["cat_ID"]) ? $_POST["cat_ID"] : 0;
$selected_categories = isset($_POST['category']) ? $_POST['category'] : [];
$selected_price = isset($_POST['price']) ? $_POST['price'] : '';
$selected_ratings = isset($_POST['rating']) ? $_POST['rating'] : [];

$query = "SELECT p.product_id, p.pro_name, p.pro_price, p.cat_id, pi.pro_image
    FROM Products p
    JOIN Product_Images pi ON p.product_id = pi.product_id
    WHERE 1=1";

$params = [];

if ($cat_id) {
    $query .= " AND p.cat_id = :cat_id";
    $params[':cat_id'] = $cat_id;
}

if (!empty($selected_categories)) {
    $query .= " AND p.cat_id IN (" . implode(',', array_map('intval', $selected_categories)) . ")";
}

if ($selected_price) {
    if ($selected_price == '200+') {
        $query .= " AND p.pro_price > 200";
    } else {
        $price_range = explode('-', $selected_price);
        $query .= " AND p.pro_price BETWEEN :min_price AND :max_price";
        $params[':min_price'] = $price_range[0];
        $params[':max_price'] = $price_range[1];
    }
}

if (!empty($selected_ratings)) {
    $query .= " AND p.product_id IN (
        SELECT product_id FROM ratings WHERE rating IN (" . implode(',', array_map('intval', $selected_ratings)) . ")
    )";
}

$query .= " GROUP BY p.product_id HAVING COUNT(pi.pro_image_id) = 1";

try {
    $Allproducts = $conn->prepare($query);
    $Allproducts->execute($params);
    $products = $Allproducts->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

if (empty($products)) {
    $query = "SELECT p.product_id, p.pro_name, p.pro_price, p.cat_id, pi.pro_image
        FROM Products p
        JOIN Product_Images pi ON p.product_id = pi.product_id
        GROUP BY p.product_id
        HAVING COUNT(pi.pro_image_id) = 1";

    $Allproducts = $conn->prepare($query);
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
                    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                    <button type="submit" style="border: none;">
                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($product['pro_image']); ?>" alt="" />
                    </button>
                </form>
                <div class="product_card_content">
                    <p class="product_card_content-name"><b><?php echo htmlspecialchars($product['pro_name']); ?></b></p>
                    <p class="product_card_content-price"><?php echo htmlspecialchars($product['pro_price']); ?> JOD</p>
                    <form action="../cart/cart2.php" method="post" style="display: inline-block;">
                        <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                        <p class="product_add-to-cart"><b><button type="submit">Add to cart</button></b></p>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>