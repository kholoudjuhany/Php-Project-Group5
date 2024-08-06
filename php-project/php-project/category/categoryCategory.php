<?php
$stmt_cat = $conn->prepare("SELECT * FROM categories limit 12");
$stmt_cat->execute();
$categori = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);
?>






<section class="flex-section">
<div class="categories-section">
    <div class="categories-section-titel">
        <p>Categories/Products</p>
    </div>
    <div class="categories-products-section">
        <?php foreach ($categori as $cat): ?>
            <form action="category.php" method="post">
                <input type="hidden" name="cat_ID" value="<?php echo htmlspecialchars($cat['cat_id']); ?>" />
                <button type="submit">
                    <div class="category-carddes">
                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($cat['cat_image']); ?>" alt="" />
                        <div class="rashrash"><?php echo htmlspecialchars($cat['cat_name']); ?></div>
                    </div>
                </button>
            </form>

        <?php endforeach ?>
    </div>
</div>

<!-- fliter -->
<div class="bcontainer">
    <!-- Sidebar -->
    <div class="bsidebar" id="bsidebar">
        <div class="bfilter-section">
            <h3>Filters</h3>
            <!-- Category Filter -->
            <div class="bfilter-group">
                <h4>Category</h4>
                <?php foreach ($categori as $cat): ?>
                    <label>
                        <input type="checkbox" name="category" value="<?php echo htmlspecialchars($cat['cat_id']); ?>">
                        <?php echo htmlspecialchars($cat['cat_name']); ?>
                    </label>
                <?php endforeach ?>
            </div>
            <!-- Price Filter -->
            <div class="bfilter-group">
                <h4>Price</h4>
                <label>
                    <input type="radio" name="price" value="0-50">
                    $0 - $50
                </label>
                <label>
                    <input type="radio" name="price" value="50-100">
                    $50 - $100
                </label>
                <label>
                    <input type="radio" name="price" value="100-200">
                    $100 - $200
                </label>
                <label>
                    <input type="radio" name="price" value="200+">
                    $200+
                </label>
            </div>
            <!-- Rating Filter -->
            <div class="bfilter-group">
                <h4>Rating</h4>
                <label>
                    <input type="checkbox" name="rating" value="1">
                    1 Star
                </label>
                <label>
                    <input type="checkbox" name="rating" value="2">
                    2 Stars
                </label>
                <label>
                    <input type="checkbox" name="rating" value="3">
                    3 Stars
                </label>
                <label>
                    <input type="checkbox" name="rating" value="4">
                    4 Stars
                </label>
           
            </div>
        </div>
    </div>
    <!-- Content -->
    <div class="bcontent">
        <button class="btoggle-btn" id="btoggleBtn">Filters</button>
        <?php include "categoryProducts.php"; ?>
    </div>
</div>
<!-- filter -->
</section>
<script>
    document.getElementById('btoggleBtn').addEventListener('click', function () {
        var sidebar = document.getElementById('bsidebar');
        if (sidebar.style.display === 'block') {
            sidebar.style.display = 'none';
        } else {
            sidebar.style.display = 'block';
        }
    });

</script>