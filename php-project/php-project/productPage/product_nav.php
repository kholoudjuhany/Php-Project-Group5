<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product_page.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/navbarStyle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/zaid.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/cart.css?v=<?php echo time(); ?>">

    <!-- bootstrap --> 
    <!-- bootstrap -->

     <!-- swiper -->
     <!-- <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" /> -->
     <!-- swiper -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- font-awesome -->
    <title>petpamper</title>


    <!-- Stylesheet -->
   
    <!---Boxicons CDN Setup for icons-->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
        <li><a href="../landingPage/landingPage.php#faq_n">FAQ</a></li> 
        <li><a href="../landingPage/landingPage.php#aboutus_n">About</a></li> 
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
