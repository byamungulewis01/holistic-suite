<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('headquarter.dashboard') }}" aria-expanded="false">
        <span>
            <i class="ti ti-aperture"></i>
        </span>
        <span class="hide-menu">{{ __('message.dashboard') }}</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#office" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-topology-star-3"></i>
        </span>
        <span class="hide-menu">Office Registration</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a href="{{ route('office.region') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Region</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('office.parish') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Parish</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('office.localChurch') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Local Church</span>
            </a>
        </li>
    </ul>
</li>

<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#users" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-users"></i>
        </span>
        <span class="hide-menu">Users</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('users.headquarter.index') }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Head Quarter</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('users.region.index') }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Region</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('users.parish.index') }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Parish</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('users.localChurch.index') }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Local Church</span>
            </a>
        </li>
    </ul>
</li>

<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">SYSTEM SETTINGS</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-layout-grid"></i>
        </span>
        <span class="hide-menu">Pre-Defined</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a href="{{ route('predefined.index') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">First Pool</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('predefined.second') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Second Pool</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('predefined.third') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Third Pool</span>
            </a>
        </li>
        {{-- <li class="sidebar-item">
            <a href="{{ route('predefined.fourth') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Fourth Pool</span>
            </a>
        </li> --}}


    </ul>
</li>
