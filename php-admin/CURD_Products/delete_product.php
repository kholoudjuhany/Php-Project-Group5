<?php
include ("../connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["productId"])) {
    $catId = $_POST['productId'];

    try {
         // Prepare and execute the first SQL statement
    $stmt1 = $conn->prepare("DELETE FROM order_details WHERE product_ID = :productId");
    $stmt1->bindParam(':productId', $catId);
    $stmt1->execute();

    // Prepare and execute the second SQL statement
    $stmt2 = $conn->prepare("DELETE FROM product_images WHERE product_ID = :productId");
    $stmt2->bindParam(':productId', $catId);
    $stmt2->execute();

    // Prepare and execute the third SQL statement
    $stmt3 = $conn->prepare("DELETE FROM products WHERE product_id = :productId");
    $stmt3->bindParam(':productId', $catId);
    $stmt3->execute();
        // Redirect to the category page after deletion
        header("Location: ../products.php");
        exit();
    } catch (PDOException $e) {
        // Error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the request method is not POST or catId is not set
    echo "Invalid request.";
}
?>