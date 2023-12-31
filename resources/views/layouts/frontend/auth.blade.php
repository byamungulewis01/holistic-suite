<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/html/main/authentication-login2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 05 Jul 2023 11:02:27 GMT -->
<head>
    <!--  Title -->
    <title>@yield('title') | AMS V0.1</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="AMS V0.1" />
    <meta name="author" content="D'amour UWIZEYE" />
    <meta name="keywords" content="AMS V0.1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo.jpeg') }}" />
    <!-- Core Css -->
    <link  id="themeColors"  rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
  </head>
  <body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="{{ asset('img/logo.jpeg') }}" alt="loader" class="lds-ripple img-fluid" />
      </div>
      <!-- Preloader -->
      <div class="preloader">
        <img src="{{ asset('img/logo.jpeg') }}" alt="loader" class="lds-ripple img-fluid" />
      </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <div class="position-relative overflow-hidden radial-gradient min-vh-100">
        <div class="position-relative z-index-5">
          <div class="row">
            <div class="col-xl-7 col-xxl-8">
              <a href="./index.html" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                <img src="{{ asset('dist/images/logos/dark-logo.svg') }}" width="180" alt="">
              </a>
              <div class="d-none d-xl-flex align-items-center justify-content-center" style="height: calc(100vh - 80px);">
                <img src="{{ asset('dist/images/backgrounds/login-security.svg') }}" alt="" class="img-fluid" width="500">
              </div>
            </div>
           @yield('body')
          </div>
        </div>

      </div>
    </div>

   <!--  Import Js Files -->
   <script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
   <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
   <!--  core files -->
   <script src="{{ asset('dist/js/app.min.js') }}"></script>
   <script src="{{ asset('dist/js/app.init.js') }}"></script>
   <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
   <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>

   <script src="{{ asset('dist/js/custom.js') }}"></script>
  </body>
</html>
