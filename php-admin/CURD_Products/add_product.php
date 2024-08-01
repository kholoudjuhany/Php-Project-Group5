<?php
include("../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productQty = $_POST['productQty'];
    $productDiscount = $_POST['productDiscount'];
    $categoryId = $_POST['categoryId'];



    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO `products` (`pro_name`, `pro_desc`, `pro_price`, `pro_qty`, `pro_create_date`, `pro_discount`, `cat_id`) 
        VALUES (:proName, :proDesc, :proPrice, :proQty, NOW(), :proDiscount, :catId)");

        // Bind the parameters
        $stmt->bindParam(':proName', $productName);
        $stmt->bindParam(':proDesc', $productDescription);
        $stmt->bindParam(':proPrice', $productPrice);
        $stmt->bindParam(':proQty', $productQty);
        $stmt->bindParam(':proDiscount', $productDiscount);
        $stmt->bindParam(':catId', $categoryId);
        // $stmt->bindParam(':proImage', $imagePath);

        // Execute the statement
        $stmt->execute();

        // Redirect to another page after successful insert
        header("Location: ../products.php");
        exit();
    } catch (PDOException $e) {
        // Error message
        echo "Error: " . $e->getMessage();
    }
}
?>