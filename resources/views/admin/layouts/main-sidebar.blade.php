<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (Route::has('front.home'))
                    <li class="nav-item">
                        <a href="{{ route('front.home') }}" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>{{ __('Visit site') }}</p>
                        </a>
                    </li>

                    <div class="post"></div>
                @endif

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link @if (request()->routeIs('admin.dashboard')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>{{ __('Dashboard') }}</p>
                    </a>
                </li>
                <div class="post"></div>

                <!-- Role menu start -->
                @if (Route::has('admin.roles.index'))
                    @if (in_array('Admin', $roles))
                        @php
                            $roleLinkActive = '';
                            $roleRoute = ['admin.roles.create', 'admin.roles.edit', 'admin.roles.show'];
                        @endphp

                        @if (request()->routeIs('admin.roles.index') ||
                            in_array(
                                request()->route()->getName(),
                                $roleRoute))
                            @php
                                $roleLinkActive = 'active';
                            @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ $roleLinkActive ?? '' }}">
                                <i class="nav-icon fas fa-lock"></i>
                                <p>{{ __('Roles') }}</p>
                            </a>
                        </li>

                        <div class="post"></div>
                    @endif
                @endif
                <!-- Role menu end -->

                <!-- Category menu start -->
                @if (Route::has('admin.categories.index'))
                    @if (in_array('Admin', $roles))
                        @php
                            $categoryLinkActive = '';
                            $categoryRoute = ['admin.categories.create', 'admin.categories.edit', 'admin.categories.show'];
                        @endphp

                        @if (request()->routeIs('admin.categories.index') ||
                            in_array(
                                request()->route()->getName(),
                                $categoryRoute))
                            @php
                                $categoryLinkActive = 'active';
                            @endphp
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}"
                                class="nav-link {{ $categoryLinkActive ?? '' }}">
                                <i class="nav-icon fas fa-tag"></i>
                                <p>{{ __('Categories') }}</p>
                            </a>
                        </li>

                        <div class="post"></div>
                    @endif
                @endif
                <!-- Category menu end -->

                <!-- User menu start -->
                @if (Route::has('admin.users.index'))
                    @if (in_array('Admin', $roles) ||
                        (in_array('Manager', $roles) && (in_array('Users', $modules) || in_array('Users Waiting Approval', $modules))))
                        @php
                            $userMenuOpen = '';
                            $userMenuActive = '';
                            
                            $userLinkActive = '';
                            $approvUserActive = '';
                        @endphp

                        @if (request()->routeIs('admin.users.index') ||
                            request()->is('admin.users/*') ||
                            request()->routeIs('admin.users.waiting.approval'))
                            @php
                                $userMenuOpen = 'menu-open';
                                $userMenuActive = 'active';
                            @endphp
                        @endif

                        @if (request()->routeIs('admin.users.index') || request()->is('admin.users/*'))
                            @php
                                $userLinkActive = 'active';
                            @endphp
                        @endif

                        @if (request()->routeIs('admin.users.waiting.approval') || request()->is('admin.users.waiting.approval/*'))
                            @php
                                $approvUserActive = 'active';
                            @endphp
                        @endif
                        <li class="nav-item {{ $userMenuOpen }}">
                            <a href="javarscript:;" class="nav-link {{ $userMenuActive }}">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    {{ __('Users') }}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @if (in_array('Admin', $roles) || (in_array('Manager', $roles) && in_array('Users', $modules)))
                                    <li class="nav-item">
                                        <a href="{{ route('admin.users.index') }}"
                                            class="nav-link {{ $userLinkActive }}">
                                            <i class="far fa-copy nav-icon"></i>
                                            <p>{{ __('Users') }}</p>
                                        </a>
                                    </li>
                                @endif

                                @if (Route::has('admin.users.waiting.approval'))
                                    @if (in_array('Admin', $roles) || (in_array('Manager', $roles) && in_array('Users Waiting Approval', $modules)))
                                        <li class="nav-item">
                                            <a href="{{ route('admin.users.waiting.approval') }}"
                                                class="nav-link {{ $approvUserActive }}">
                                                <i class="fas fa-th nav-icon"></i>
                                                <p>{{ __('Waiting Approval') }}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </li>

                        <div class="post"></div>
                    @endif
                @endif
                <!-- User menu end -->

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

                <div class="post"></div>

                <li class="nav-item">&nbsp;</li>
                <div class="post"></div>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
