<!-- <button class="toggle-cart-btn">View Cart</button> -->

<div class="cart-sidebar">
    <div class="cart-header">
        <div class="right">
            <button class="close-btn">&times;</button>
            <h3>Cart</h3>
        </div>
        <img src="Shopping_Cart.png">
    </div>
    <div class="cart-body">
        <div class="cart-item">
            <img src="image-removebg-preview.png" alt="Sands">
            <div class="item-details">
                <h4>Cleaner Sands</h4>
                <p>JOD 106</p>
                <div class="quantity-control">
                    <button class="decrease">-</button>
                    <input type="text" value="1">
                    <button class="increase">+</button>
                </div>
            </div>
            <!----------- zaid (start edt) --------->
            <img src="Trash.png" id="Trash_Single" alt="">
            <!----------- zaid (end edt) ----------->
        </div>
        <div class="order-summary">
            <h4>Order Summary</h4>
            <p>Subtotal: <span>JOD 106</span></p>
            <p>Delivery charges: <span>JOD 3</span></p>
            <p>Total: <span>JOD 109</span></p>
        </div>
        <!----------- zaid (start edt) --------->
        <div class="Trash_main">
            <div class="Trash_All">
                <h4>Delete All :</h4>
                <img src="Trash.png" id="Trash.png">
            </div>
        </div>
        <div id="message-container-cart"></div>
        <!----------- zaid (end edt) ----------->
        <div class="cart-footer">
            <button class="checkout-btn">
                <a href="../checkout/checkoutPage.php">
                Checkout
                </a>
            </button>
            <button class="continue-shopping-btn">Continue Shopping</button>
        </div>
    </div>
</div>



