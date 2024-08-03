<!-- include top start  -->
<?php include("../include/topUserPage.php");?>
<!-- include top end -->

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
        <li><a href="../landingPage/landingPage.php#aboutus_n">About us</a></li> 
        <li><a href="../landingPage/landingPage.php#">Contact</a></li>
        <li><a href="../loginPage/LoginForm.php">Login/Signup</a></li>
       <li> 
        <a href="#" class="toggle-cart-btn"  >
       
        
          <i class="fa-solid fa-cart-shopping fa-lg "></i>
     
      </a>
      </li>
        <!-- fix404 add link and name -->
      </ul>
    </div>
  </div>
</nav>
