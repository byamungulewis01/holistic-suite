<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('parish.dashboard') }}" aria-expanded="false">
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
            <a href="{{ route('parish.office.localChurch') }}" class="sidebar-link">
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
            <i class="ti ti-settings"></i>
        </span>
        <span class="hide-menu">Users</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="#employee" aria-expanded="false">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">Employees</span>
            </a>
            <ul aria-expanded="false" class="collapse two-level">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('parish.parishUser.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Parish</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('parish.localChurchUser.index') }}">
                        <div class="round-16 d-flex align-items-center justify-content-center">
                            <i class="ti ti-circle"></i>
                        </div>
                        <span class="hide-menu">Local Church</span>
                    </a>

                </li>
            </ul>
        </li>
    </ul>
</li>
