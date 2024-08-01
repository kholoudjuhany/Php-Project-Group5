<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

  <!-- logo start -->
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.php"><img src="assets/images/logo.svg" alt="logo" /></a>
    <a class="navbar-brand brand-logo-mini" href="index.php"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
  </div>
  <!-- logo end -->

  <div class="navbar-menu-wrapper d-flex align-items-stretch">

    <!-- menu icon start -->
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <!-- menu icon end -->


    <!-- search bar start -->
    <div class="search-field d-none d-md-block">
      <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
          <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
          </div>
          <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
        </div>
      </form>
    </div>
    <!-- search bar end -->


    <!-- navbar icon start -->
    <ul class="navbar-nav navbar-nav-right">
      <!-- admin name start -->
      <li class="nav-item nav-profile ">
        <a class="nav-link dropdown-toggle">
          <div class="nav-profile-img">
            <i class="mdi mdi-account"></i>
          </div>

          <div class="nav-profile-text">
            <!-- add the admin name fix404 -->
            <p class="mb-1 text-black">David Greymaax</p>
            <!-- add the admin name fix404  -->
          </div>
        </a>
      </li>
      <!-- admin name end -->


      <!-- full screen mode start  -->
      <li class="nav-item d-none d-lg-block full-screen-link">
        <a class="nav-link">
          <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
        </a>
      </li>
      <!-- full screen mode end  -->


      <!-- exit Dashboard start  -->
      <li class="nav-item nav-logout d-none d-lg-block">
        <a class="nav-link" href="home.php">
          <i class="mdi mdi-exit-to-app"></i>
          <b>Exit</b>
        </a>
      </li>
      <!-- exit Dashboard start  -->

    </ul>
    <!--  navbaricon end -->

    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
      data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>