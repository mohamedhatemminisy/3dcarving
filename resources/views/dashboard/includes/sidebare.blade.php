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

                        @canany(['customers.create', 'customers.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.customers')}}</span></a>
                                <ul class="menu-content">
                                        @can('customers.create')
                                        <li><a class="menu-item" href="{{route('customers.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_customer')}}</a>
                                        </li>
                                        @endcan
                                        @can('customers.index')
                                        <li><a class="menu-item" href="{{route('customers.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_customers')}}</a>
                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan

                        @canany(['units.create', 'units.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.units')}}</span></a>
                                <ul class="menu-content">
                                        @can('units.create')
                                        <li><a class="menu-item" href="{{route('units.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_unit')}}</a>
                                        </li>
                                        @endcan
                                        @can('units.index')
                                        <li><a class="menu-item" href="{{route('units.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_units')}}</a>
                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan
                        @canany(['categories.create', 'categories.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.categories')}}</span></a>
                                <ul class="menu-content">
                                        @can('categories.create')
                                        <li><a class="menu-item" href="{{route('categories.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_category')}}</a>
                                        </li>
                                        @endcan
                                        @can('categories.index')
                                        <li><a class="menu-item" href="{{route('categories.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_categories')}}</a>
                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan
                        @canany(['machines.create', 'machines.index'])
                        <li class=" nav-item"><a href="#"><i class="la la-arrows-h"></i><span class="menu-title"
                                                data-i18n="nav.horz_nav.main">{{trans('admin.machines')}}</span></a>
                                <ul class="menu-content">
                                        @can('machines.create')
                                        <li><a class="menu-item" href="{{route('machines.create')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.create_machine')}}</a>
                                        </li>
                                        @endcan
                                        @can('machines.index')
                                        <li><a class="menu-item" href="{{route('machines.index')}}"
                                                        data-i18n="nav.horz_nav.horizontal_navigation_types.main">
                                                        {{trans('admin.show_machines')}}</a>
                                        </li>
                                        @endcan
                                </ul>
                        </li>
                        @endcan
                </ul>
        </div>
</div>