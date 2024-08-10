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
    <link rel="stylesheet" href="../style/navbarStyle.css?v=<?php echo time(); ?>">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" tybe="icon" href="../images/Dog-Pet-PNG-Cutout.png">

    <style>
                :root {
            --background-color: #f7f5f2;
            --text-color: #434343;
            --primary-color: #D93250;
            --secondary-color: #A62648;
            --border-color: #ddd;
        }

        body {
            /* margin: 20px; */
            background: var(--background-color);
            font-family: Arial, sans-serif;
            color: var(--text-color);
        }

        table img {
            width: 100%;
        }

        .container9 {
            max-width: 1200px;
            margin: 40px auto;
            
        }

        .ibox9 {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .ibox-title9 {
            border-bottom: 2px solid var(--border-color);
            padding: 15px;
            background-color: var(--background-color);
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            color: var(--text-color);
            display: flex;
            justify-content: space-between;
        }

        .ibox-title9 h5 {
            margin: 0;
            font-size: 18px;
        }

        .ibox-title9 span {
            /* margin-top: 10px; */
            float: right;
            font-weight: bold;
            color: var(--primary-color);
            padding-right: 20px;
        }

        .ibox-content9 {
            padding: 20px;
        }

        .table-responsive9 {
            overflow-x: auto;
        }

        .shopping-cart-table9 {
            width: 100%;
            border-collapse: collapse;
        }

        .shopping-cart-table9 th,
        .shopping-cart-table9 td {
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
            text-align: left;
        }

        .shopping-cart-table9 td:last-child {
            text-align: right;
        }

        .cart-product-imitation9 {
            width: 100px;
            height: 100px;
            background-color: var(--background-color);
            border-radius: 8px;
            margin: 0 auto;
        }

        .text-navy9 {
            color: var(--primary-color);
        }

        .btn-primary9 {
            background-color: var(--primary-color);
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .btn-primary9:hover {
            background-color: var(--secondary-color);
        }

        .btn-white9 {
            background-color: #ffffff;
            color: var(--text-color);
            border: 1px solid var(--border-color);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-align: center;
        }

        .btn-white9:hover {
            background-color: #f5f5f5;
        }

        .font-bold9 {
            font-weight: bold;
        }

        .small9 {
            font-size: 0.875em;
            color: #666;
        }

        .text-center9 {
            text-align: center;
        }

        .text-muted9 {
            color: #999;
        }

        .product-name9 {
            font-weight: bold;
            color: var(--primary-color);
        }

        .text-right9 {
            text-align: right;
        }

        .m-t-xs9 {
            margin-top: 5px;
        }

        .m-t-sm9 {
            margin-top: 10px;
        }

        .m-t-md9 {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-desc9 {
            padding: 20px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .col-md-99,
            .col-md-39 {
                width: 100%;
                padding: 0;
                margin-bottom: 15px;
            }

            .ibox-content9 {
                padding: 15px;
            }

            .cart-product-imitation9 {
                width: 80px;
                height: 80px;
                padding: 10px;
            }
        }
    </style>
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

    <div class="container9">
        <div class="row9">
            <div class="col-md-99">
                <div class="ibox9">
                    <div class="ibox-title9">
                        <h5>Items in your cart</h5>
                        <span>(<strong><?php echo count($cart); ?></strong>) items</span>
                    </div>
                    <div class="ibox-content9">
                        <div class="table-responsive9">
                            <table class="table shopping-cart-table9">
                                <tbody>
                                    <?php if (!empty($cart)) : ?>
                                        <?php foreach ($cart as $product) : ?>
                                            <tr>
                                                <td width="120">
                                                    <?php if (!empty($product['pro_image'])) : ?>
                                                        <img src="../../../php-admin/uploads/<?php echo htmlspecialchars($product['pro_image']); ?>" alt="<?php echo htmlspecialchars($product['pro_name']); ?>" class="product-image9" />
                                                    <?php else : ?>
                                                        <div class="cart-product-imitation9"></div>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="desc9">
                                                    <h3>
                                                        <a href="#" class="text-navy9"><?php echo htmlspecialchars($product['pro_name']); ?></a>
                                                    </h3>
                                                    <p class="small9">
                                                        <?php echo htmlspecialchars($product['pro_desc']); ?>
                                                    </p>
                                                    <dl class="small9">
                                                        <dt>Category</dt>
                                                        <dd><?php echo htmlspecialchars($product['cat_id']); ?></dd>
                                                    </dl>
                                                    <div class="m-t-sm9">
                                                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display:inline;">
                                                            <input type="hidden" name="removeProductId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                                            <button type="submit" class="text-muted9" style="border:none; background:none; cursor:pointer;">
                                                                <i class="fa fa-trash"></i> Remove item
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                <td><b><?php echo number_format($product['pro_price'], 2); ?> JOD</b></td>
                                                <td width="80">
                                                    <input id="quantity-<?php echo $product['product_id']; ?>" type="number" class="form-control9" value="1" min="1" data-price="<?php echo $product['pro_price']; ?>">
                                                </td>
                                                <td>
                                                    <h4 id="total-price-<?php echo $product['product_id']; ?>"><b><?php echo number_format($product['pro_price'], 2); ?> JOD</b></h4>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="text-center9">No items in cart.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row9">
            <div class="col-md-99">
                <div class="ibox9">
                    <div class="ibox-title9">
                        <h5>Total :</h5>
                    </div>
                    <div class="ibox-content9">
                        <div class="m-t-md9">
                            <div class="m-t-md-m9">
                                <form method="post" action="../checkout/checkoutPage.php" style="display: inline-block;">
                                    <input type="hidden" name="cart" value="<?php echo json_encode($cart); ?>">
                                    <input type="hidden" name="totalPrice" id="totalPrice">
                                    <a href="../checkout/checkoutPage.php">
                                    <button type="submit" class="btn btn-primary9"><i class="fa fa-shopping-cart"></i>Checkout</button>
                                    </a>
                                </form>
                                <a href="../category/category.php">
                                <button class="btn btn-white9"><i class="fa fa-arrow-left"></i> Continue shopping</button>
                                </a>
                            </div>
                            <div class="m-t-md-mt9">
                                <h3>Total price: <span id="total-price">$330.00</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="text-center text-lg-start bg-body-tertiary text-muted" id="footerf">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2024 Copyright: for Pawzy G5
    </div>
  </footer>
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

    // Set the total price value to the hidden input field before submitting the form
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('totalPrice').value = document.getElementById('total-price').innerText;
    });

    // Initial calculation
    updateTotalPrice();
</script>

</html>