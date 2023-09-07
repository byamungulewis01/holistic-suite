<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('localChurch.dashboard') }}" aria-expanded="false">
        <span>
            <i class="ti ti-aperture"></i>
        </span>
        <span class="hide-menu">{{ __('message.dashboard') }}</span>
    </a>
</li>
{{-- member --}}
<li class="sidebar-item">
    <a class="sidebar-link has-arrow {{ in_array(Route::currentRouteName(), ['localChurch.member.show','localChurch.member.create','localChurch.member.edit','localChurch.children.show','localChurch.children.create','localChurch.children.edit','localChurch.penitent.show','localChurch.penitent.create','localChurch.penitent.edit','localChurch.teenager.show','localChurch.teenager.create','localChurch.teenager.edit','localChurch.friend.show','localChurch.friend.create','localChurch.friend.edit']) ? 'active' : '' }}"
        href="#member" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-user"></i>
        </span>
        <span class="hide-menu">{{ __('church/churchNav.member') }}</span>
    </a>
    <ul aria-expanded="false"
        class="collapse first-level {{ in_array(Route::currentRouteName(), ['localChurch.member.show','localChurch.member.create','localChurch.member.edit','localChurch.children.show','localChurch.children.create','localChurch.children.edit','localChurch.penitent.show','localChurch.penitent.create','localChurch.penitent.edit','localChurch.teenager.show','localChurch.teenager.create','localChurch.teenager.edit','localChurch.friend.show','localChurch.friend.create','localChurch.friend.edit']) ? 'in' : '' }}">
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.member.show','localChurch.member.create','localChurch.member.edit']) ? 'active' : '' }}">
            <a href="{{ route('localChurch.member.index') }}"
                class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.member.show','localChurch.member.create','localChurch.member.edit']) ? 'active' : '' }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">{{ __('church/churchNav.member') }}</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.children.show','localChurch.children.create','localChurch.children.edit']) ? 'active' : '' }}">
            <a href="{{ route('localChurch.children.index') }}"
                class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.children.show','localChurch.children.create','localChurch.children.edit']) ? 'active' : '' }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">{{ __('church/churchNav.children') }}</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.penitent.show','localChurch.penitent.create','localChurch.penitent.edit']) ? 'active' : '' }}">
            <a href="{{ route('localChurch.penitent.index') }}"
                class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.penitent.show','localChurch.penitent.create','localChurch.penitent.edit']) ? 'active' : '' }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">{{ __('church/churchNav.penitent') }}</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.teenager.show','localChurch.teenager.create','localChurch.teenager.edit']) ? 'active' : '' }}">
            <a href="{{ route('localChurch.teenager.index') }}"
                class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.teenager.show','localChurch.teenager.create','localChurch.teenager.edit']) ? 'active' : '' }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu"> {{ __('church/churchNav.teenager') }}</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.friend.show','localChurch.friend.create','localChurch.friend.edit']) ? 'active' : '' }}">
            <a href="{{ route('localChurch.friend.index') }}"
                class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.friend.show','localChurch.friend.create','localChurch.friend.edit']) ? 'active' : '' }}">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu"> {{ __('church/churchNav.friends') }}</span>
            </a>
        </li>

    </ul>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.step.members','localChurch.step.schedule']) ? 'active' : '' }}
    " href="{{ route('localChurch.step.index') }}" aria-expanded="false">
        <span>
            <i class="ti ti-list-details"></i>
        </span>
        <span class="hide-menu"> {{ __('church/churchNav.classStep') }}</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.group.members']) ? 'active' : '' }}"
        href="{{ route('localChurch.group.index') }}" aria-expanded="false">
        <span class="rounded-3">
            <i class="ti ti-chart-donut-3"></i>
        </span>
        <span class="hide-menu">{{ __('church/churchNav.group') }}</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.commission.members']) ? 'active' : '' }}"
        href="{{ route('localChurch.commission.index') }}" aria-expanded="false">
        <span class="rounded-3">
            <i class="ti ti-cpu"></i>
        </span>
        <span class="hide-menu">{{ __('church/churchNav.commission') }}</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link {{ in_array(Route::currentRouteName(), ['localChurch.sundaySchool.members','localChurch.sundaySchool.addChild']) ? 'active' : '' }}"
        href="{{ route('localChurch.sundaySchool.index') }}" aria-expanded="false">
        <span class="rounded-3">
            <i class="ti ti-file-pencil"></i>
        </span>
        <span class="hide-menu">{{ __('church/churchNav.sundaySchool') }}</span>
    </a>
</li>

<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#member" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-archive"></i>
        </span>
        <span class="hide-menu"> {{ __('church/churchNav.calling') }}</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li class="sidebar-item">
            <a href="{{ route('localChurch.calling.index') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">{{ __('church/churchNav.calling') }}</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a href="{{ route('localChurch.calling.sundaySchool') }}" class="sidebar-link">
                <div class="round-16 d-flex align-items-center justify-content-center">
                    <i class="ti ti-circle"></i>
                </div>
                <span class="hide-menu">{{ __('church/churchNav.sundaySchoolTeacher') }}</span>
            </a>
        </li>

    </ul>
</li>
<li class="nav-small-cap">
    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
    <span class="hide-menu">Online Services</span>
</li>
<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
        <span class="d-flex">
            <i class="ti ti-cards"></i>
        </span>
        <span class="hide-menu">Recommandation</span>
    </a>
    <ul aria-expanded="false" class="collapse first-level">
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.recommandation.transferList']) ? 'active' : '' }}">
            <a href="{{ route('localChurch.recommandation.transferList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Transfer</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.recommandation.moving']) ? 'active' : '' }}">
            <a href="#" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Guterana</span>
            </a>
        </li>
        <li
            class="sidebar-item {{ in_array(Route::currentRouteName(), ['localChurch.recommandation.moving']) ? 'active' : '' }}">
            <a href="##" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Gusaba Akazi</span>
            </a>
        </li>
    </ul>
</li>
<li class="sidebar-item">
    <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
        <span class="rounded-3">
            <i class="ti ti-file-text"></i>
        </span>
        <span class="hide-menu">Member Step</span>
    </a>
    <ul aria-expanded="false"
        class="collapse first-level {{ in_array(Route::currentRouteName(), ['localChurch.memberStep.childrenPraysList','localChurch.memberStep.funeralList','localChurch.memberStep.weddingProjectList','localChurch.memberStep.holyCommunionList']) ? 'in' : '' }}">
        <!-- form elements -->
        <li class="sidebar-item {{ Request::routeIs('localChurch.memberStep.weddingProjectList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.memberStep.weddingProjectList') }}"
                class="sidebar-link {{ Request::routeIs('localChurch.memberStep.weddingProjectList') ? 'active' : '' }}">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Umushinga w'Ubukwe</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.memberStep.childrenPraysList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.memberStep.childrenPraysList') }}"
                class="sidebar-link {{ Request::routeIs('localChurch.memberStep.childrenPraysList') ? 'active' : '' }}">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Gusengera Umwana</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.memberStep.funeralList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.memberStep.funeralList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Gushyingura</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.memberStep.holyCommunionList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.memberStep.holyCommunionList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Igaburo Ryera</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.memberStep.prayerRequestList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.memberStep.prayerRequestList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Icyifuzo cyo Gusengera</span>
            </a>
        </li>
    </ul>
</li>
<li class="sidebar-item">
    <a class="sidebar-link two-column has-arrow" href="#" aria-expanded="false">
        <span class="rounded-3">
            <i class="ti ti-app-window"></i>
        </span>
        <span class="hide-menu">Other Service</span>
    </a>
    <ul aria-expanded="false"
        class="collapse first-level {{ in_array(Route::currentRouteName(),
    ['localChurch.request.suggestionList','localChurch.request.praiseRequestList','localChurch.request.choirMoveList','localChurch.request.leaderMeetRequestList']) ? 'in' : '' }}">
        <!-- form elements -->
        <li class="sidebar-item {{ Request::routeIs('localChurch.request.suggestionList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.request.suggestionList','localChurch.request.preachRequestList','localChurch.request.socialMediaPreachList') }}"
                class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Suggestions</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.request.praiseRequestList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.request.praiseRequestList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Gushima Imana</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.request.preachRequestList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.request.preachRequestList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Preach Permit</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.request.socialMediaPreachList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.request.socialMediaPreachList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Social Media Preach</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.request.choirMoveList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.request.choirMoveList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Choir Preach</span>
            </a>
        </li>
        <li class="sidebar-item {{ Request::routeIs('localChurch.request.leaderMeetRequestList') ? 'active' : '' }}">
            <a href="{{ route('localChurch.request.leaderMeetRequestList') }}" class="sidebar-link">
                <i class="ti ti-circle"></i>
                <span class="hide-menu">Meet Leaders</span>
            </a>
        </li>
    </ul>
</li>
