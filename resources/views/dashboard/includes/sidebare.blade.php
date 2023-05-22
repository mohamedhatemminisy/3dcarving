<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
        <div class="main-menu-content">
                <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                        @can('admin.dashboard')
                        <li class=" nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-arrows-h"></i><span
                                                class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.home')}}</span></a>
                        </li>
                        @endcan

                        @canany(['users.create', 'users.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.users')}}</span></a>
                                <ul class="menu-content">
                                        @can('users.create')
                                        <li><a class="menu-item" href="{{route('users.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_user')}}</a>
                                        </li>
                                        @endcan
                                        @can('users.index')
                                        <li><a class="menu-item" href="{{route('users.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_users')}}</a>

                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan

                        @canany(['roles.create', 'roles.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.roles')}}</span></a>
                                <ul class="menu-content">
                                        @can('roles.create')
                                        <li><a class="menu-item" href="{{route('roles.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_role')}}</a>
                                        </li>
                                        @endcan
                                        @can('roles.index')
                                        <li><a class="menu-item" href="{{route('roles.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_roles')}}</a>

                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan

                        @canany(['permissions.create', 'permissions.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.permissions')}}</span></a>
                                <ul class="menu-content">
                                        @can('permissions.create')
                                        <li><a class="menu-item" href="{{route('permissions.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_permission')}}</a>
                                        </li>
                                        @endcan
                                        @can('permissions.index')
                                        <li><a class="menu-item" href="{{route('permissions.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_permissions')}}</a>

                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan

                        
                        @canany(['parties.create', 'parties.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.parties')}}</span></a>
                                <ul class="menu-content">
                                        @can('parties.create')
                                        <li><a class="menu-item" href="{{route('parties.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_party')}}</a>
                                        </li>
                                        @endcan
                                        @can('parties.index')
                                        <li><a class="menu-item" href="{{route('parties.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_parties')}}</a>

                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan

                        @canany(['donations.create', 'donations.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.donations')}}</span></a>
                                <ul class="menu-content">
                                        @can('donations.create')
                                        <li><a class="menu-item" href="{{route('donations.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_donation')}}</a>
                                        </li>
                                        @endcan
                                        @can('donations.index')
                                        <li><a class="menu-item" href="{{route('donations.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_donations')}}</a>

                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan
                </ul>
        </div>
</div>