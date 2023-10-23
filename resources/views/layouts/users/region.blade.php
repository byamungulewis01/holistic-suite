<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('region.dashboard') }}" aria-expanded="false">
        <span>
            <i class="ti ti-aperture"></i>
        </span>
        <span class="hide-menu">Dashboard</span>
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
            <a href="{{ route('region.office.parish') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Parish</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('region.office.localChurch') }}" class="sidebar-link">
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
            <a class="sidebar-link" href="{{ route('region.regionUser.index') }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Region</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('region.parishUser.index') }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Parish</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('region.localChurchUser.index') }}">
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
    <span class="hide-menu">Reports</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-qrcode"></i>
        </span>
        <span class="hide-menu">Region Reports</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a href="{{ route('region.report.members') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Members General report</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('region.report.genderAndAge') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Member Gender & Age</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('region.report.educationLevel') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Member Education Level</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('region.report.socialSecurity') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Member Social Security</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('region.report.savingType') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Member Savings</span>
            </a>
        </li>
    </ul>
</li>
