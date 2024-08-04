<?php
include("../connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve cart data and total price from the POST request
    $cart = isset($_POST['cart']) ? json_decode($_POST['cart'], true) : [];
    $totalPrice = isset($_POST['totalPrice']) ? floatval($_POST['totalPrice']) : 0;

    // Check if cart is not empty
    if (!empty($cart)) {
        try {
            // Start a transaction
            $conn->beginTransaction();

            // Insert order data
            $stmt = $conn->prepare("INSERT INTO `order` (order_date, total_price) VALUES (NOW(), :totalPrice)");
            $stmt->bindParam(':totalPrice', $totalPrice, PDO::PARAM_STR);
            $stmt->execute();
            $orderId = $conn->lastInsertId(); // Get the last inserted order ID

            // Insert order details
            $stmt = $conn->prepare("
                INSERT INTO order_details (order_id, product_id, quantity, price)
                VALUES (:orderId, :productId, :quantity, :price)
            ");

            foreach ($cart as $product) {
                $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
                $stmt->bindParam(':productId', $product['product_id'], PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $product['quantity'], PDO::PARAM_INT); // Ensure correct key for quantity
                $stmt->bindParam(':price', $product['pro_price'], PDO::PARAM_STR);
                $stmt->execute();
            }

            // Commit the transaction
            $conn->commit();

            // Clear cart cookie
            setcookie('cart', '', time() - 3600, "/");

            echo "Order placed successfully!";
        } catch (PDOException $e) {
            // Rollback the transaction if something goes wrong
            $conn->rollBack();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No items in the cart.";
    }
} else {
    echo "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style/checkout.css">
</head>

<body>
    <div class="checkout-container">
        <h1 class="checkout-title">Order Summary</h1>

        <div class="order-summary">
            <h2>Cart</h2>
            <div class="order-item">
                <p><strong>1 item in cart</strong></p>
            </div>
        </div>

        <div class="order-details">
            <h2>Order Details</h2>
            <div class="summary-item">
                <span>Subtotal</span>
                <span>$32.00</span>
            </div>
            <div class="summary-item">
                <span>Cash on Delivery</span>
                <span>$5.00</span>
            </div>
            <div class="summary-item">
                <span>Shipping (Flat Rate-Fixed)</span>
                <span>$5.00</span>
            </div>
            <div class="order-total">
                <span><strong>Order Total</strong></span>
                <span>$42.00</span>
            </div>
        </div>

        <div class="shipping-info">
            <h2>Ship To:</h2>
            <p><strong>Veronica Costello</strong></p>
            <p>6146 Honey Bluff Parkway</p>
            <p>Ha Noi, Michigan 10000</p>
            <p>Vietnam</p>
            <p>(555) 279-1826</p>
        </div>

        <div class="shipping-method">
            <h2>Shipping Method</h2>
            <p>Flat Rate Fixed</p>
            <button class="btn" id="submitOrder">Place Order</button>
            <button class="btn" id="cancelbtn">
                <a href="../category/category.php">Cancel</a>
            </button>
        </div>
    </div>
</body>

</html>