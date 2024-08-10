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
    <link rel="icon" tybe="icon" href="../images/Dog-Pet-PNG-Cutout.png">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style/checkout.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/navbarStyle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>

<body>

<nav class="navbar1">
  <div class="container1">
    <div class="navbar1-menu" id="open-navbar1">
  
      <button class="navbar1-toggler" data-toggle="open-navbar1">
        <span></span>
        <span></span>
        <span></span>
      </button>
      
      <a href="../landingPage/landingPage.php">
        <img src="../images/logo.png" alt="logo" width="50%">
      </a>
    
      <ul class="navbar1-nav">
        <li ><a href="../landingPage/landingPage.php">Home</a></li>
        <li class="navbar1-dropdown">
          <a href="../category/category.php" class="dropdown-toggler" data-dropdown="my-dropdown-id">
            Categories 
          </a>
          <!-- dropdown list start -->

          <!-- <ul class="dropdown" id="my-dropdown-id">
            <li><a href="#">Actions</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="separator"></li>
            <li><a href="#">Seprated link</a></li>
            <li class="separator"></li>
            <li><a href="#">One more seprated link.</a></li>
          </ul> -->

          <!-- dropdown list end -->

        </li>
        <li class="navbar1-dropdown">
          <a href="../landingPage/landingPage.php#services_n" class="dropdown-toggler" data-dropdown="blog">
          Services 
          </a>
          <!-- dropdown list start -->

          <!-- <ul class="dropdown" id="blog">
            <li><a href="#">Some category</a></li>
            <li><a href="#">Some another category</a></li>
            <li class="separator"></li>
            <li><a href="#">Seprated link</a></li>
            <li class="separator"></li>
            <li><a href="#">One more seprated link.</a></li>
          </ul> -->

          <!-- dropdown list end -->

        </li>
        <!-- fix404 add link and name -->
        <li><a href="../landingPage/landingPage.php#aboutus_n">About</a></li> 
        <li><a href="../landingPage/landingPage.php#faq_n">FAQ</a></li> 
        <li><a href="../landingPage/landingPage.php#footerf">Contact</a></li>
        <li><a href="../loginPage/LoginForm.php">Login/Signup</a></li>
       <li> 
        <a href="../cart/cart2.php" class="toggle-cart-btn"  >
       
        
          <i class="fa-solid fa-cart-shopping fa-lg "></i>
     
      </a>
      </li>
        <!-- fix404 add link and name -->
      </ul>
    </div>
  </div>
</nav>

    <div class="checkout-container8">
        <h1 class="checkout-title8">Order Summary</h1>

        <div class="order-summary8">
            <h2>Cart</h2>
            <div class="order-item8">
                <p><strong>1 item in cart</strong></p>
            </div>
        </div>

        <div class="order-details8">
            <h2>Order Details</h2>
            <div class="summary-item8">
                <span>Subtotal</span>
                <span>$32.00</span>
            </div>
            <div class="summary-item8">
                <span>Cash on Delivery</span>
                <span>$5.00</span>
            </div>
            <div class="summary-item8">
                <span>Shipping (Flat Rate-Fixed)</span>
                <span>$5.00</span>
            </div>
            <div class="order-total8">
                <span><strong>Order Total</strong></span>
                <span>$42.00</span>
            </div>
        </div>

        <div class="shipping-info8">
            <h2>Ship To:</h2>
            <p><strong>Veronica Costello</strong></p>
            <p>6146 Honey Bluff Parkway</p>
            <p>Ha Noi, Michigan 10000</p>
            <p>Vietnam</p>
            <p>(555) 279-1826</p>
        </div>

        <div class="shipping-method8">
            <h2>Shipping Method</h2>
            <p>Flat Rate Fixed</p>
            <button class="btn8" id="submitOrder">Place Order</button>
            <button class="btn8" id="cancelbtn">
                <a href="../category/category.php">Cancel</a>
            </button>
        </div>
    </div>

    <footer class="text-center text-lg-start bg-body-tertiary text-muted" id="footerf">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2024 Copyright: for Pawzy G5
    </div>
  </footer>
</body>

</html>