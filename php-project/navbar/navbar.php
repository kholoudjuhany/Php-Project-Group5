<!-- include top start  -->
<?php include("../include/topUserPage.php");?>
<!-- include top end -->

<nav class="navbar1">
  <div class="container1">

    <div class="navbar1-header">
      <button class="navbar1-toggler" data-toggle="open-navbar1">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a href="#">
        <h4>Awesome<span>logo</span></h4>
      </a>
    </div>

    <div class="navbar1-menu" id="open-navbar1">
      <ul class="navbar1-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="navbar1-dropdown">
          <a href="#" class="dropdown-toggler" data-dropdown="my-dropdown-id">
            Categories <i class="fa fa-angle-down"></i>
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
          <a href="#" class="dropdown-toggler" data-dropdown="blog">
            Blog <i class="fa fa-angle-down"></i>
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
        <li><a href="#">About</a></li> 
        <li><a href="#">Contact</a></li>
        <li><a href="#">Signin</a></li>
        <!-- fix404 add link and name -->
      </ul>
    </div>
  </div>
</nav>
