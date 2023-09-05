<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Title -->
    <title>@yield('title') | AMS V0.1</title>
    <!-- Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="AMS V0.1" />
    <meta name="author" content="D'amour UWIZEYE" />
    <meta name="keywords" content="AMS V0.1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('img/logo.jpeg') }}" />

    <!-- Core Css -->
    @yield('css')
    <link rel="stylesheet" href="{{ asset('dist/libs/jquery-raty-js/lib/jquery.raty.css') }}">
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
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
    <!-- Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="horizontal" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
      <!-- Header Start -->
      <header class="app-header">
       @include('layouts.frontend.navbar')
    </header>
    <!-- Header End -->
    <!-- Sidebar Start -->

    @include('layouts.frontend.sidebar')
      <!-- Sidebar End -->
      <!-- Main wrapper -->
      <div class="body-wrapper">
        <div class="container-fluid">
          @yield('body')

        </div>
      </div>
      <div class="dark-transparent sidebartoggler"></div>
    </div>



    <!--  Customizer -->

    <!-- Customizer -->

    <!-- Import Js Files -->
    <script src="{{ asset('dist/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- core files -->
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/plugins/toastr-init.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif
            @if(Session::has('error'))
                toastr.error("{{ Session::get('error') }}");
            @endif
            @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
            @if(Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
            @endif

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif
    });
    // document.addEventListener('contextmenu', event => event.preventDefault());
    </script>
    @yield('script')
    <!-- current page js files -->
  </body>
</html>
