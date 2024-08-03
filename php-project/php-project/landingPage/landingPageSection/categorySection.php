    <!-- rasha -->
    <?php


    $stmt_cat = $conn->prepare("SELECT * FROM categories limit 12");

    $stmt_cat->execute();

    $categori = $stmt_cat->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="categories-section">
        <div class="categories-section-titel">
            <div class="mainnn">
                <h1>Explore Categories</h1>
                <br />
                <span class="span-category">Explore our most popular blooms</span>
            </div>
            <div class="ALS#EE">
                <a href="#" class="view-all-link">View All</a>
            </div>
        </div>
        <div class="categories-container">
            <?php foreach ($categori as $cat) : ?>
                <div class="category-box">
                    <div class="category-title"><?php echo htmlspecialchars($cat['cat_name']) ?></div>
                    <img src="../../../php-admin/uploads/<?php echo $cat['cat_image'] ?>" alt="" />
                </div>
            <?php endforeach ?>
        </div>


    </div>