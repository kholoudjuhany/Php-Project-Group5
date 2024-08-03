<?php
include("../connection/connect.php");

// Function to get product details from database
function getProductDetails($conn, $productId)
{
    $query = $conn->prepare("
        SELECT 
            products.product_id,
            products.pro_name,
            products.pro_desc,
            products.pro_price,
            products.pro_qty,
            products.pro_create_date,
            products.pro_discount,
            products.cat_id,
            product_images.pro_image
        FROM products
        LEFT JOIN product_images ON products.product_id = product_images.product_id
        WHERE products.product_id = :productId
    ");
    $query->bindParam(':productId', $productId, PDO::PARAM_INT);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Add to cart logic
if (isset($_POST['productId'])) {
    $productId = intval($_POST['productId']);
    $product = getProductDetails($conn, $productId);

    if ($product) {
        // Retrieve existing cart from cookie
        $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

        // Check if the product is already in the cart
        $found = false;
        foreach ($cart as $key => $item) {
            if ($item['product_id'] == $productId) {
                $found = true;
                break;
            }
        }

        // Add the product to the cart if not already present
        if (!$found) {
            $cart[] = $product;
            setcookie('cart', json_encode($cart), time() + (86400 * 7), "/"); // 7 days expiration
        }

        // Redirect to avoid resubmission on refresh
        header("Location: cart2.php");
        exit();
    }
}

// Remove from cart logic
if (isset($_POST['removeProductId'])) {
    $removeProductId = intval($_POST['removeProductId']);

    // Retrieve existing cart from cookie
    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];

    // Remove the product from the cart
    foreach ($cart as $key => $item) {
        if ($item['product_id'] == $removeProductId) {
            unset($cart[$key]);
            break;
        }
    }

    // Re-index array and update cookie
    $cart = array_values($cart);
    setcookie('cart', json_encode($cart), time() + (86400 * 7), "/"); // 7 days expiration

    // Redirect to avoid resubmission on refresh
    header("Location: cart2.php");
    exit();
}

// Retrieve products from cookie
$cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <style>
         :root {
            --background-color: #f7f5f2;
            --text-color: #434343;
            --primary-color: #D93250;
            --secondary-color: #A62648;
            --border-color: #ddd;
        }

        body {
            margin: 20px;
            background: var(--background-color);
            font-family: Arial, sans-serif;
            color: var(--text-color);
        }

        table img {
            width: 100%;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .ibox {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .ibox-title {
            border-bottom: 2px solid var(--border-color);
            padding: 15px;
            background-color: var(--background-color);
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            color: var(--text-color);
        }

        .ibox-title h5 {
            margin: 0;
            font-size: 18px;
        }

        .ibox-title span {
            float: right;
            font-weight: bold;
            color: var(--primary-color);
        }

        .ibox-content {
            padding: 20px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .shopping-cart-table {
            width: 100%;
            border-collapse: collapse;
        }

        .shopping-cart-table th,
        .shopping-cart-table td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }

        .shopping-cart-table td:last-child {
            text-align: right;
        }

        .cart-product-imitation {
            width: 100px;
            height: 100px;
            background-color: var(--background-color);
            border-radius: 8px;
            margin: 0 auto;
        }

        .text-navy {
            color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-white {
            background-color: #ffffff;
            color: var(--text-color);
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .btn-white:hover {
            background-color: #f5f5f5;
        }

        .font-bold {
            font-weight: bold;
        }

        .small {
            font-size: 0.875em;
            color: #666;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #999;
        }

        .product-name {
            font-weight: bold;
            color: var(--primary-color);
        }

        .text-right {
            text-align: right;
        }

        .m-t-xs {
            margin-top: 5px;
        }

        .m-t-sm {
            margin-top: 10px;
        }

        .m-t-md {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-desc {
            padding: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .col-md-9,
            .col-md-3 {
                width: 100%;
                padding: 0;
                margin-bottom: 15px;
            }

            .ibox-content {
                padding: 15px;
            }

            .cart-product-imitation {
                width: 80px;
                height: 80px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Items in your cart</h5>
                        <span>(<strong><?php echo count($cart); ?></strong>) items</span>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table shopping-cart-table">
                                <tbody>
                                    <?php if (!empty($cart)) : ?>
                                        <?php foreach ($cart as $product) : ?>
                                            <tr>
                                                <td width="120">
                                                    <?php if (!empty($product['pro_image'])) : ?>
                                                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($product['pro_image']); ?>" alt="<?php echo htmlspecialchars($product['pro_name']); ?>" class="product-image" />
                                                    <?php else : ?>
                                                        <div class="cart-product-imitation"></div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="desc">
                                                    <h3>
                                                        <a href="#" class="text-navy"><?php echo htmlspecialchars($product['pro_name']); ?></a>
                                                    </h3>
                                                    <p class="small">
                                                        <?php echo htmlspecialchars($product['pro_desc']); ?>
                                                    </p>
                                                    <dl class="small">
                                                        <dt>Category</dt>
                                                        <dd><?php echo htmlspecialchars($product['cat_id']); ?></dd>
                                                    </dl>
                                                    <div class="m-t-sm">
                                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display:inline;">
                                                            <input type="hidden" name="removeProductId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                                            <button type="submit" class="text-muted"  style="border:none; background:none; cursor:pointer;">
                                                                <i class="fa fa-trash"></i> Remove item
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td><?php echo number_format($product['pro_price'], 2); ?> JOD</td>
                                                <td width="80">
                                                    <input id="quantity-<?php echo $product['product_id']; ?>" type="number" class="form-control" value="1" min="1" data-price="<?php echo $product['pro_price']; ?>">
                                                </td>
                                                <td>
                                                    <h4 id="total-price-<?php echo $product['product_id']; ?>"><?php echo number_format($product['pro_price'], 2); ?> JOD</h4>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No items in cart.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Total :</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="m-t-md">
                            <div class="m-t-md-m">
                                <button class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Checkout</button>
                                <button class="btn btn-white"><i class="fa fa-arrow-left"></i> Continue shopping</button>
                            </div>
                            <div class="m-t-md-mt">
                                <h3>Total price: <span id="total-price">$330.00</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function updateTotalPrice() {
        let total = 0;
        document.querySelectorAll('input[type="number"]').forEach(function (input) {
            var quantity = parseInt(input.value);
            var price = parseFloat(input.getAttribute('data-price'));
            var totalPriceElement = document.getElementById('total-price-' + input.id.split('-')[1]);
            var itemTotal = price * quantity;
            totalPriceElement.innerText = itemTotal.toFixed(2) + ' JOD';
            total += itemTotal;
        });
        document.getElementById('total-price').innerText = total.toFixed(2) + ' JOD';
    }

    document.querySelectorAll('input[type="number"]').forEach(function (input) {
        input.addEventListener('input', updateTotalPrice);
    });

    // Initial calculation
    updateTotalPrice();
</script>

</html>

<?php
// session_start();
?>
</html>