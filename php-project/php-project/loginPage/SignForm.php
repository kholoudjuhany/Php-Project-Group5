<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="regist.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container" id="signup">
        <h1 class="form-title">Sign Up</h1></br>
        <form id="regist" method="post" action="regist.php">
            <div id="signupMessage" class="messageDiv" style="display:none;"></div>

            <div class="input-group-horizontal">
                <div class="input-group-item">
                    <label for="signupFirstName">First Name</label>
                    <input type="text" id="signupFirstName" name="firstName">
                    <!-- <span class="error-message" id="signupFirstNameError">Please enter your first name</span> -->
                </div>
                <div class="input-group-item">
                    <label for="signupLastName">Last Name</label>
                    <input type="text" id="signupLastName" name="lastName">
                    <!-- <span class="error-message" id="signupLastNameError">Please enter your last name</span> -->
                </div>
            </div>

            <div class="input-group">
                <div class="input-group-item">
                    <label for="signupEmail">Email</label>
                    <input type="email" id="signupEmail" name="email">
                    <!-- <span class="error-message" id="signupEmailError">Please use a valid email</span> -->
                </div>
                <div class="input-group-item">
                    <label for="signupPassword">Password</label>
                    <input type="password" id="signupPassword" name="password">
                    <!-- <span class="error-message" id="signupPasswordError">Please fill this field as it is</span> -->
                </div>
                <div class="input-group-item">
                    <label for="signupMobile">Mobile</label>
                    <input type="tel" id="signupMobile" name="mobile">
                    <!-- <span class="error-message" id="signupMobileError">Please enter your mobile number</span> -->
                </div>
                <div class="input-group-item">
                    <label for="signupCity">City</label>
                    <input type="text" id="signupCity" name="city">
                    <!-- <span class="error-message" id="signupCityError">Please enter your city</span> -->
                </div>
                <div class="address-group">
                    <div class="input-group-item">
                        <label for="signupStreet">Street</label>
                        <input type="text" id="signupStreet" name="street">
                        <!-- <span class="error-message" id="signupStreetError">Please enter your street</span> -->
                    </div>
                    <div class="input-group-item">
                        <label for="signupAddress">Building Number</label>
                        <input type="text" id="signupAddress" name="building_number">
                        <!-- <span class="error-message" id="signupAddressError">Please enter your address</span> -->
                    </div>
                </div>
            </div>

            <button class="btn" id="submitSignUp"><b>Sign Up</b></button>
        </form>
        <p class="links">Already have an account? <a href="LoginForm.php" id="loginButton">Login</a></p>
    </div>
</body>
</html>





