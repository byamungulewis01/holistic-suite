<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar container-fluid">
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <!-- =================== -->
                <!-- Dashboard -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::routeIs('member.home') ? 'active' : '' }}"
                        href="{{ route('member.home') }}">
                        <span>
                            <i class="ti ti-home-2"></i>
                        </span>
                        <span class="hide-menu">{{ __('client/sidebar.home') }}</span>
                    </a>
                </li>
                <!-- ============================= -->
                <!-- Profile -->
                <!-- ============================= -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::routeIs('member.profile') ? 'active' : '' }}"
                        href="{{ route('member.profile') }}">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">{{ __('church/member.profile') }}</span>
                    </a>
                </li>

                <!-- =================== -->
                <!-- Apex Chart -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow {{ in_array(Route::currentRouteName(), ['member.recommandation.moving']) ? 'active' : '' }}"
                        href="#" aria-expanded="false">
                        <span class="rounded-3">
                            <i class="ti ti-chart-pie"></i>
                        </span>
                        <span class="hide-menu">Recommandation</span>
                    </a>
                    <ul aria-expanded="false"
                        class="collapse first-level {{ in_array(Route::currentRouteName(), ['member.recommandation.moving']) ? 'in' : '' }}">
                        <li
                            class="sidebar-item {{ in_array(Route::currentRouteName(), ['member.recommandation.transferList']) ? 'active' : '' }}">
                            <a href="{{ route('member.recommandation.transferList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Transfer</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item {{ in_array(Route::currentRouteName(), ['member.recommandation.moving']) ? 'active' : '' }}">
                            <a href="#" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Guterana</span>
                            </a>
                        </li>
                        <li
                            class="sidebar-item {{ in_array(Route::currentRouteName(), ['member.recommandation.moving']) ? 'active' : '' }}">
                            <a href="##" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Gusaba Akazi</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- ============================= -->
                <!-- Icons -->
                <!-- ============================= -->

                <!-- Forms -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Member Step</span>
                </li>
                <!-- =================== -->
                <!-- Forms -->
                <!-- =================== -->
                <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                        <span class="rounded-3">
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="hide-menu">Member Step</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ in_array(Route::currentRouteName(), ['member.memberStep.childrenPraysList','member.memberStep.funeralList','member.memberStep.weddingProjectList','member.memberStep.holyCommunionList']) ? 'in' : '' }}">
                        <!-- form elements -->
                        <li class="sidebar-item {{ Request::routeIs('member.memberStep.weddingProjectList') ? 'active' : '' }}">
                            <a href="{{ route('member.memberStep.weddingProjectList') }}" class="sidebar-link {{ Request::routeIs('member.memberStep.weddingProjectList') ? 'active' : '' }}">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Umushinga w'Ubukwe</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.memberStep.childrenPraysList') ? 'active' : '' }}">
                            <a href="{{ route('member.memberStep.childrenPraysList') }}" class="sidebar-link {{ Request::routeIs('member.memberStep.childrenPraysList') ? 'active' : '' }}">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Gusengera Umwana</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.memberStep.funeralList') ? 'active' : '' }}">
                            <a href="{{ route('member.memberStep.funeralList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Gushyingura</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.memberStep.holyCommunionList') ? 'active' : '' }}">
                            <a href="{{ route('member.memberStep.holyCommunionList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Igaburo Ryera</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.memberStep.prayerRequestList') ? 'active' : '' }}">
                            <a href="{{ route('member.memberStep.prayerRequestList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Icyifuzo cyo Gusengera</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link two-column has-arrow" href="#" aria-expanded="false">
                        <span class="rounded-3">
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="hide-menu">Other Service</span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level {{ in_array(Route::currentRouteName(),
                    ['member.request.suggestionList','member.request.praiseRequestList','member.request.choirMoveList','member.request.leaderMeetRequestList']) ? 'in' : '' }}">
                        <!-- form elements -->
                        <li class="sidebar-item {{ Request::routeIs('member.request.suggestionList') ? 'active' : '' }}">
                            <a href="{{ route('member.request.suggestionList','member.request.preachRequestList','member.request.socialMediaPreachList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Suggestions</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.request.praiseRequestList') ? 'active' : '' }}">
                            <a href="{{ route('member.request.praiseRequestList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Gushima Imana</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.request.preachRequestList') ? 'active' : '' }}">
                            <a href="{{ route('member.request.preachRequestList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Preach Permit</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.request.socialMediaPreachList') ? 'active' : '' }}">
                            <a href="{{ route('member.request.socialMediaPreachList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Social Media Preach</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.request.choirMoveList') ? 'active' : '' }}">
                            <a href="{{ route('member.request.choirMoveList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Choir Preach</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ Request::routeIs('member.request.leaderMeetRequestList') ? 'active' : '' }}">
                            <a href="{{ route('member.request.leaderMeetRequestList') }}" class="sidebar-link">
                                <i class="ti ti-circle"></i>
                                <span class="hide-menu">Meet Leaders</span>
                            </a>
                        </li>
                    </ul>
                </li>


            </ul>
            <div class="unlimited-access hide-menu bg-light-primary position-relative my-7 rounded d-block d-lg-none">
                <div class="d-flex">
                    <div class="unlimited-access-title">
                        <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">Unlimited Access</h6>
                        <button class="btn btn-primary fs-2 fw-semibold lh-sm">Signup</button>
                    </div>
                    <div class="unlimited-access-img">
                        <img src="../../dist/images/backgrounds/rocket.png" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3 mx-9 d-block d-lg-none">
        <div class="hstack gap-3 justify-content-between">
            <div class="john-img">
                <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="42" height="42" alt="">
            </div>
            <div class="john-title">
                <h6 class="mb-0 fs-4">John Doe</h6>
                <span class="fs-2">Designer</span>
            </div>
            <button class="border-0 bg-transparent text-primary ms-2" tabindex="0" type="button" aria-label="logout"
                data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                <i class="ti ti-power fs-6"></i>
            </button>
        </div>
    </div>
</aside>
