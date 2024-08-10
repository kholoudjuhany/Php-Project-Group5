<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="regist.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="signup.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/navbarStyle.css?v=<?php echo time(); ?>">
    <link rel="icon" tybe="icon" href="../images/Dog-Pet-PNG-Cutout.png">

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
          
        </li>
        <li class="navbar1-dropdown">
          <a href="../landingPage/landingPage.php#services_n" class="dropdown-toggler" data-dropdown="blog">
          Services 
          </a>
          


        </li>
     
        <li><a href="../landingPage/landingPage.php#aboutus_n">About</a></li> 
        <li><a href="../landingPage/landingPage.php#faq_n">FAQ</a></li> 
        <li><a href="../landingPage/landingPage.php#footerf">Contact</a></li>
        <li><a href="../loginPage/LoginForm.php">Login/Signup</a></li>
       <li> 
        <a href="../cart/cart2.php" class="toggle-cart-btn"  >
       
        
          <i class="fa-solid fa-cart-shopping fa-lg "></i>
     
      </a>
      </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container5" id="signup">
        <h1 class="form-title5"><b>Sign Up</b></h1></br>
        <form id="regist" method="post" action="regist.php">
            <div id="signupMessage" class="messageDiv5" style="display:none;"></div>

            <div class="input-group-horizontal5">
                <div class="input-group-item5">
                    <label for="signupFirstName">First Name</label>
                    <input type="text" id="signupFirstName" name="firstName">
                    <!-- <span class="error-message" id="signupFirstNameError">Please enter your first name</span> -->
                </div>
                <div class="input-group-item5">
                    <label for="signupLastName">Last Name</label>
                    <input type="text" id="signupLastName" name="lastName">
                    <!-- <span class="error-message" id="signupLastNameError">Please enter your last name</span> -->
                </div>
            </div>

            <div class="input-group5">
                <div class="input-group-item5">
                    <label for="signupEmail">Email</label>
                    <input type="email" id="signupEmail" name="email">
                    <!-- <span class="error-message" id="signupEmailError">Please use a valid email</span> -->
                </div>
                <div class="input-group-item5">
                    <label for="signupPassword">Password</label>
                    <input type="password" id="signupPassword" name="password">
                    <!-- <span class="error-message" id="signupPasswordError">Please fill this field as it is</span> -->
                </div>
                <div class="input-group-item5">
                    <label for="signupMobile">Mobile</label>
                    <input type="tel" id="signupMobile" name="mobile">
                    <!-- <span class="error-message" id="signupMobileError">Please enter your mobile number</span> -->
                </div>
                <div class="input-group-item5">
                    <label for="signupCity">City</label>
                    <input type="text" id="signupCity" name="city">
                    <!-- <span class="error-message" id="signupCityError">Please enter your city</span> -->
                </div>
                <div class="address-group5">
                    <div class="input-group-item5">
                        <label for="signupStreet">Street</label>
                        <input type="text" id="signupStreet" name="street">
                        <!-- <span class="error-message" id="signupStreetError">Please enter your street</span> -->
                    </div>
                    <div class="input-group-item5">
                        <label for="signupAddress">Building Number</label>
                        <input type="text" id="signupAddress" name="building_number">
                        <!-- <span class="error-message" id="signupAddressError">Please enter your address</span> -->
                    </div>
                </div>
            </div>

            <button class="btn5" id="submitSignUp"><b>Sign Up</b></button>
        </form>
        <p class="links5">Already have an account? <a href="LoginForm.php" id="loginButton">Login</a></p>
    </div>

    <footer class="text-center text-lg-start bg-body-tertiary text-muted" id="footerf">
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2024 Copyright: for Pawzy G5
  </div>
  </footer>

</body>
</html>





