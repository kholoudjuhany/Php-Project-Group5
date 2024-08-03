<?php
// Fetch categories for display
$stmt_disc = $conn->prepare("SELECT p.product_id, p.pro_name, p.pro_price, p.pro_discount, pi.pro_image
FROM products p
JOIN product_images pi ON p.product_id = pi.product_id
WHERE p.pro_discount IS NOT NULL AND p.pro_discount > 0;
limit 5
");
$stmt_disc->execute();
$productsDiconts = $stmt_disc->fetchAll(PDO::FETCH_ASSOC);
?>




<div class="Gift-section">
    <div class="Gift-section-titel">
      <div class="mainnn">
        <h1>Explore Gift</h1>
        <br />
        <span class="span-category">Explore our most popular blooms</span>
      </div>
      <div class="ALS#EE">
        <a href="#" class="view-all-link">View All</a>
      </div>
    </div>
    <div class="Gift-container">
        <?php foreach($productsDiconts as $productsDicont): ?>
      <div class="category-box">
        <div class="category-title"><?php echo $productsDicont['pro_name']; ?></div>
        <img src="../../../php-admin/uploads/<?php echo $productsDicont['pro_image']; ?>" />
      </div>
        <?php endforeach; ?>
    </div>
  </div>