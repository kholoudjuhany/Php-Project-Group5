<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productId"])) {
    $productId = $_POST['productId'];
    
    // Fetch product details
    $stmt = $conn->prepare("SELECT `product_id`, `pro_name`, `pro_desc`, `pro_price`, `pro_qty`, `pro_create_date`, `pro_discount`, `cat_id` FROM `products` WHERE product_id = :productId");
    $stmt->bindParam(":productId", $productId);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productId"]) && isset($_POST["productName"]) && isset($_POST["productPrice"]) && isset($_POST["productQty"]) && isset($_POST["productDiscount"]) && isset($_POST["productDescription"]) && isset($_POST["catId"])) {
    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $productPrice = $_POST["productPrice"];
    $productQty = $_POST["productQty"];
    $productDiscount = $_POST["productDiscount"];
    $productDescription = $_POST["productDescription"];
    $catId = $_POST["catId"];

    $stmt = $conn->prepare("UPDATE `products` SET `pro_name` = :productName, `pro_desc` = :productDescription, `pro_price` = :productPrice, `pro_qty` = :productQty, `pro_discount` = :productDiscount, `cat_id` = :catId WHERE `product_id` = :productId");
    $stmt->bindParam(":productName", $productName);
    $stmt->bindParam(":productDescription", $productDescription);
    $stmt->bindParam(":productPrice", $productPrice);
    $stmt->bindParam(":productQty", $productQty);
    $stmt->bindParam(":productDiscount", $productDiscount);
    $stmt->bindParam(":catId", $catId);
    $stmt->bindParam(":productId", $productId);
  
    $stmt->execute();
    // fix404 
    // header("refresh: 0");
    // header("Location:../Products.php");
    
    // exit();
    
}
?>





 <!-- Modal -->
 <!-- Edit Form Modal Start -->
<div class="modal fade" id="editForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFormLabel">Edit Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Product Form</h4>
                            <p class="card-description">Update the product details</p>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                                <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Product Name" value="<?php echo htmlspecialchars($product['pro_name']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="productPrice">Product Price</label>
                                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Product Price" value="<?php echo htmlspecialchars($product['pro_price']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="productQty">Product Quantity</label>
                                    <input type="number" class="form-control" id="productQty" name="productQty" placeholder="Product Quantity" value="<?php echo htmlspecialchars($product['pro_qty']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="catId">Category</label>
                                    <select class="form-control" id="catId" name="catId" required>
                                        <?php
                                        // Fetch and display categories for the dropdown
                                        $categoryStmt = $conn->prepare("SELECT cat_id, cat_name FROM categories");
                                        $categoryStmt->execute();
                                        $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($categories as $category) : ?>
                                            <option value="<?php echo htmlspecialchars($category['cat_id']); ?>" <?php echo $category['cat_id'] == $product['cat_id'] ? 'selected' : ''; ?>>
                                                <?php echo htmlspecialchars($category['cat_name']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="productDiscount">Discount</label>
                                    <input type="number" class="form-control" id="productDiscount" name="productDiscount" placeholder="Discount" value="<?php echo htmlspecialchars($product['pro_discount']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="productDescription">Description</label>
                                    <textarea class="form-control" id="productDescription" name="productDescription" rows="4" required><?php echo htmlspecialchars($product['pro_desc']); ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2" onclick="refONClick">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Edit Form Modal End -->


    <script>
    // Refresh the page
    function refONClick (){
        setTimeout(function(){
        location.reload();
    }, 1000);
    }; 
</script>
