    <!--start header -->
    <header>
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <div class="mobile-toggle-menu"><i class="bx bx-menu"></i></div>
                <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <input type="text" class="form-control search-control"
                            placeholder="{{ __('sidbar.search') }}" />
                        <span class="position-absolute top-50 search-show translate-middle-y"><i
                                class="bx bx-search"></i></span>
                        <span class="position-absolute top-50 search-close translate-middle-y"><i
                                class="bx bx-x"></i></span>
                    </div>
                </div>
                <div class="top-menu ms-auto">
                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item mobile-search-icon">
                            <a class="nav-link" href="#">
                                <i class="bx bx-search"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <p style="margin: 0; display: flex; align-items: center">
                                    <span
                                        style="font-size: 18px; font-weight: 400">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                                    <i class="bx bx-chevron-down"></i>
                                </p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="width: 150px">
                                <div class="row row-cols-1 g-3 p-3">
                                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <a class="dropdown-item" rel="alternate" hreflang="ar"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                            {{ $properties['native'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="alert-count">7</span>
                                <i class="bx bx-bell"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Notifications</p>
                                        <p class="msg-header-clear ms-auto">
                                            Marks all as read
                                        </p>
                                    </div>
                                </a>
                                <div class="header-notifications-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-success text-success">
                                                <i class="bx bx-file"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">
                                                    24 PDF File<span class="msg-time float-end">19 min ago</span>
                                                </h6>
                                                <p class="msg-info">The pdf files generated</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="notify bg-light-danger text-danger">
                                                <i class="bx bx-message-detail"></i>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">
                                                    New Comments
                                                    <span class="msg-time float-end">4 hrs ago</span>
                                                </h6>
                                                <p class="msg-info">
                                                    New customer comments recived
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">
                                        View All Notifications
                                    </div>
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="alert-count">8</span>
                                <i class="bx bx-comment"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Messages</p>
                                        <p class="msg-header-clear ms-auto">
                                            Marks all as read
                                        </p>
                                    </div>
                                </a>
                                <div class="header-message-list">
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('assets/images/avatars/avatar-1.png') }}"
                                                    class="msg-avatar" alt="user avatar" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">
                                                    Daisy Anderson
                                                    <span class="msg-time float-end">5 sec ago</span>
                                                </h6>
                                                <p class="msg-info">The standard chunk of lorem</p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('assets/images/avatars/avatar-2.png') }}"
                                                    class="msg-avatar" alt="user avatar" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">
                                                    Althea Cabardo
                                                    <span class="msg-time float-end">14 sec ago</span>
                                                </h6>
                                                <p class="msg-info">
                                                    Many desktop publishing packages
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="dropdown-item" href="javascript:;">
                                        <div class="d-flex align-items-center">
                                            <div class="user-online">
                                                <img src="{{ asset('assets/images/avatars/avatar-3.png') }}"
                                                    class="msg-avatar" alt="user avatar" />
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="msg-name">
                                                    Oscar Garner
                                                    <span class="msg-time float-end">8 min ago</span>
                                                </h6>
                                                <p class="msg-info">
                                                    Various versions have evolved over
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">
                                        View All Messages
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="user-box dropdown">
                    <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret"
                        href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/images/avatars/avatar-1.png') }}" class="user-img"
                            alt="user avatar" />
                        <div class="user-info ps-3">
                            <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                            <p class="designattion mb-0">{{ auth()->user()->email }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth('admin')
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i
                                        class="bx bx-user"></i><span>{{ __('sidbar.profile') }}</span></a>
                            </li>
                        @else
                            <li>
                                <a class="dropdown-item" href="{{ route('teacher.profile.index') }}"><i
                                        class="bx bx-user"></i><span>{{ __('sidbar.profile') }}</span></a>
                            </li>
                        @endauth
                        <li>
                            <div class="dropdown-divider mb-0"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="document.getElementById('form-logout').submit()"
                                href="javascript:;"><i
                                    class="bx bx-log-out-circle"></i><span>{{ __('sidbar.logout') }}</span></a>
                            @auth('admin')
                                <form id="form-logout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input name="auth" value="admin" type="hidden">
                                </form>
                                @elseauth('teacher')
                                <form id="form-logout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <input name="auth" value="teacher" type="hidden">
                                </form>
                            @endauth
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <!--end header -->
