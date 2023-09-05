<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        @php
        if (auth()->user()->role == 'headquarter') {
        $url = route('headquarter.dashboard');
        } elseif (auth()->user()->role == 'region') {
        $url = route('region.dashboard');
        } elseif (auth()->user()->role == 'parish') {
        $url = route('parish.dashboard');
        } elseif (auth()->user()->role == 'local church') {
        $url = route('localChurch.dashboard');
        }
        @endphp
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ $url }}" class="text-nowrap logo-img">
                <img src="{{ asset('img/logo.png') }}" class="dark-logo" width="220" alt="" />
                <img src="{{ asset('img/logo.png') }}" class="light-logo" width="220" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>

                @if (auth()->user()->role == 'headquarter')
                 @include('layouts.users.headquarter')
                @elseif (auth()->user()->role == 'region')
                    @include('layouts.users.region')
                @elseif (auth()->user()->role == 'parish')
                    @include('layouts.users.parish')
                @elseif (auth()->user()->role == 'local church')
                    @include('layouts.users.local-church')
                @endif

            </ul>
        </nav>

    </div>
    <!-- End Sidebar scroll-->
</aside>
