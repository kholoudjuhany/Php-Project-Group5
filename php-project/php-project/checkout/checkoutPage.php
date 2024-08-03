<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>
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
            <button class="btn" id="submitSignUp">place ordar</button>
            <button class="btn" id="cancelbtn">
                <a href="../category/category.php">

                    cancel
                </a>
            </button>
        </div>
    </div>
</body>

</html>