@inject('authorization', 'App\Services\AuthorizationService')
<aside class="main-sidebar sidebar-dark-primary elevation-0 bg-info">
    <a href="{{ route('profile.update-details') }}" class="brand-link">
        <img src="{{ $userImage }}" alt="{{ $basicInfo->title }} Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8" height="30" width="30">
        <span class="brand-text font-weight-dark text-dark">{{ Auth::guard('admin')->user()->name }}</span>
    </a>
    <div class="sidebar" style="background-color: #083344">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                {{-- @if ($authorization->hasMenuAccess(1))
                    <li class="nav-item">
                        <a href="{{ route('menus.index') }}"
                            class="nav-link {{ request()->is('admin/menus*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Menu Manage
                            </p>
                        </a>
                    </li>
                @endif --}}

                @if (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 0)
                    <li class="nav-item {{ request()->is('admin/dashboard*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                            <span class="badge badge-danger pending_orders_in_kit"></span>
                        </a>
                    </li>
                    <li
                        class="nav-item {{ Request::routeIs('clients.index') || Request::routeIs('client.create') || Request::routeIs('client.store') || Request::routeIs('clients.edit') ? 'menu-open' : '' }}">
                        <a href="#"
                            class="nav-link {{ Request::routeIs('clients.index') || Request::routeIs('client.create') || Request::routeIs('client.store') || Request::routeIs('clients.edit') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Client Manage
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('clients.index') }}"
                                    class="nav-link {{ Request::routeIs('clients.index') || Request::routeIs('clients.edit') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Clients</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=" {{ route('client.create') }}"
                                    class="nav-link {{ Request::routeIs('client.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if (
                        $authorization->hasMenuAccess(37) ||
                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 0))
                        <li class="nav-item">
                            <a href="{{ route('units.index') }}"
                                class="nav-link {{ request()->is('admin/basic-setup/units*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Units <i class="fas right fa-solid fa-plus add-new p-1"
                                        add-new="{{ route('units.create') }}"></i></p>
                            </a>
                        </li>
                    @endif

                @endif
                @if (
                    $authorization->hasMenuAccess(159) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/dashboard*') ? 'menu-open' : '' }}">
                        <a href="{{ route('dashboard.index') }}"
                            class="nav-link {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                            <span class="badge badge-danger pending_orders_in_kit"></span>
                        </a>
                    </li>
                @endif
                @if (
                    $authorization->hasMenuAccess(160) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/basic-setup*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/basic-setup*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-circle-info"></i>
                            <p>Basic Setup<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $authorization->hasMenuAccess(11) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('basic-infos.index') }}"
                                        class="nav-link {{ request()->is('admin/basic-setup/basic-infos*') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-dot-circle text-warning"></i>
                                        <p>Basic Info</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(14) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}"
                                        class="nav-link {{ request()->is('admin/basic-setup/roles*') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-dot-circle text-warning"></i>
                                        <p>Roles <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('roles.create') }}"></i>
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(15) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('admins.index') }}"
                                        class="nav-link {{ request()->is('admin/basic-setup/admins*') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-dot-circle text-warning"></i>
                                        <p>Admins <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('admins.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(22) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('profile.update-details') }}"
                                        class="nav-link {{ request()->is('admin/basic-setup/profile*') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-dot-circle text-warning"></i>
                                        <p>My Profile</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(23) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('admin.password.update') }}"
                                        class="nav-link {{ request()->is('admin/basic-setup/password*') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-dot-circle text-warning"></i>
                                        <p>Update Password</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(99) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('payment-methods.index') }}"
                                        class="nav-link {{ request()->is('admin/inventory/setup/payment-methods*') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-dot-circle text-warning"></i>
                                        <p>Payment Methods <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('payment-methods.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                {{-- @if ($authorization->hasMenuAccess(111) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/hrm*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/hrm*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users-line"></i>
                            <p>Human Resource<i class="right fas fa-angle-left"></i></p>
                        </a>
                        @if ($authorization->hasMenuAccess(113) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('admin/hrm/setup*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('admin/hrm/setup*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-users-gear nav-icon"></i>
                                        <p>Setup<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($authorization->hasMenuAccess(149) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('hrsettings.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/hrsettings*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Settings</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(141) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('departments.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/departments*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Departments <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('departments.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(142) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('divisions.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/divisions*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Divisions <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('divisions.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(151) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('designations.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/designations*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Designation <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('designations.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(152) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('employees.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/employees*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Employee <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('employees.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(125) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('weekly-holidays.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/weekly-holidays*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Weekly Holiday</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(126) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('holidays.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/holidays*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Holiday <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('holidays.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(127) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('leave-types.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/setup/leave-types*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Leave Type <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('leave-types.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if ($authorization->hasMenuAccess(114) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('admin/hrm/attendances*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('admin/hrm/attendances*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-calendar-check"></i>
                                        <p>Attendance<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($authorization->hasMenuAccess(138) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('attendances.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/attendances/attendances*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Attendance
                                                        <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('attendances.create') }}"></i>
                                                        <i class="fas right fa-solid fa-list-check add-new p-1 mr-1"
                                                            add-new="{{ route('attendances.create-or-edit-multiple') }}"></i>
                                                    </p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(139) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('attendance-processes.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/attendances/attendance-processes*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Attendance Process</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(140) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('attendances-reports.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/attendances/reports*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Attendance Report</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if ($authorization->hasMenuAccess(115) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('admin/hrm/leaves*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('admin/hrm/leaves*') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-suitcase-rolling"></i>
                                        <p>Leave<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($authorization->hasMenuAccess(132) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('leaves.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/leaves/leaves*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Leave <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('leaves.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(128) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('leave-reports.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/leaves/reports*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Leave Report</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if ($authorization->hasMenuAccess(116) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('admin/hrm/loans*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('admin/hrm/loans*') ? 'active' : '' }}">
                                        <i class="fas fa-hand-holding-usd nav-icon"></i>
                                        <p>Loan<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($authorization->hasMenuAccess(121) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('loans.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/loans/loans*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Loan <i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('loans.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(120) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('loan-processes.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/loans/loan-processes*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Loan Process</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                        @if ($authorization->hasMenuAccess(117) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->is('admin/hrm/payrolls*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('admin/hrm/payrolls*') ? 'active' : '' }}">
                                        <i class="fas fa-money-bill-wave nav-icon"></i>
                                        <p>Payrolls<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if ($authorization->hasMenuAccess(119) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('salary-processes.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/payrolls/salary-processes*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Salary Process</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if ($authorization->hasMenuAccess(118) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('salaries.index') }}"
                                                    class="nav-link {{ request()->is('admin/hrm/payrolls/salaries*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Salary</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            </ul>
                        @endif
                    </li>
                @endif --}}
                @if (
                    $authorization->hasMenuAccess(24) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    {{-- <li class="nav-item {{ Request::routeIs('categories*') ||  Request::routeIs('sub-categories*') ||  Request::routeIs('products*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{Request::routeIs('categories*') ||  Request::routeIs('sub-categories*') ||  Request::routeIs('products*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-pizza-slice"></i>
                            <p>Category Manage <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if ($authorization->hasMenuAccess(25) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('categories.index') }}"
                                        class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Category <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('categories.create') }}"></i>
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($authorization->hasMenuAccess(29) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('sub-categories.index') }}"
                                        class="nav-link {{ request()->is('admin/sub-categories*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Sub Category <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('sub-categories.create') }}"></i>
                                        </p>
                                    </a>
                                </li>
                            @endif
                            @if ($authorization->hasMenuAccess(33) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}"
                                        class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Products <i class="fas right fa-solid fa-plus add-new p-1" add-new="{{ route('products.index') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li> --}}

                    @if (
                        $authorization->hasMenuAccess(25) ||
                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}"
                                class="nav-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Category <i class="fas right fa-solid fa-plus add-new p-1"
                                        add-new="{{ route('categories.create') }}"></i>
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (
                        $authorization->hasMenuAccess(29) ||
                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <li class="nav-item">
                            <a href="{{ route('sub-categories.index') }}"
                                class="nav-link {{ request()->is('admin/sub-categories*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Sub Category <i class="fas right fa-solid fa-plus add-new p-1"
                                        add-new="{{ route('sub-categories.create') }}"></i>
                                </p>
                            </a>
                        </li>
                    @endif
                    @if (
                        $authorization->hasMenuAccess(33) ||
                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <li class="nav-item">
                            <a href="{{ route('products.index') }}"
                                class="nav-link {{ request()->is('admin/products*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Products <i class="fas right fa-solid fa-plus add-new p-1"
                                        add-new="{{ route('products.index') }}"></i></p>
                            </a>
                        </li>
                    @endif
                    @if (
                        $authorization->hasMenuAccess(33) ||
                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <li class="nav-item">
                            <a href="{{ route('vendors.index') }}"
                                class="nav-link {{ request()->is('admin/vendors*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Vendors <i class="fas right fa-solid fa-plus add-new p-1"
                                        add-new="{{ route('vendors.index') }}"></i></p>
                            </a>
                        </li>
                    @endif
                    @if (
                        $authorization->hasMenuAccess(33) ||
                            (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                        <li class="nav-item">
                            <a href="{{ route('suppliers.index') }}"
                                class="nav-link {{ request()->is('admin/suppliers*') ? 'active' : '' }}">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Suppliers <i class="fas right fa-solid fa-plus add-new p-1"
                                        add-new="{{ route('suppliers.index') }}"></i></p>
                            </a>
                        </li>
                    @endif
                @endif
                @if (
                    $authorization->hasMenuAccess(77) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/purchases*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/purchases*') ? 'active' : '' }}">
                            <i class="nav-icon fa-regular fa-credit-card"></i>
                            <p>Purchase Manage <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $authorization->hasMenuAccess(78) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('purchases.index') }}"
                                        class="nav-link {{ Request::routeIs('purchases.index') || Request::routeIs('purchases.edit') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Purchase </p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(79) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('purchases.create') }}"
                                        class="nav-link {{ Request::routeIs('purchases.create') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>New Purchase </p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(80) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('purchase-return.index') }}"
                                        class="nav-link {{ Request::routeIs('purchase-return.index') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Purchase Returns</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (
                    $authorization->hasMenuAccess(77) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/sales*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/sales*') ? 'active' : '' }}">
                            <i class="nav-icon fa-regular fa-credit-card"></i>
                            <p>Sales Manage <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $authorization->hasMenuAccess(78) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('sales.index') }}"
                                        class="nav-link {{ Request::routeIs('sales.index') || Request::routeIs('sales.edit') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Sales</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(79) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('sales.create') }}"
                                        class="nav-link {{ Request::routeIs('sales.create') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>New Sales </p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(80) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('sales-return.index') }}"
                                        class="nav-link {{ Request::routeIs('sales-return.index') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Sales Return</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                {{-- @if (
                    $authorization->hasMenuAccess(161) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/inventory*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/inventory*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-warehouse"></i>
                            <p>Inventory<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $authorization->hasMenuAccess(162) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item {{ request()->is('admin/inventory/setup*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('admin/inventory/setup*') ? 'active' : '' }}">
                                        <i class="fa-solid fa-users-gear nav-icon"></i>
                                        <p>Setup<i class="right fas fa-angle-left"></i></p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (
                                            $authorization->hasMenuAccess(163) ||
                                                (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                            <li class="nav-item">
                                                <a href="{{ route('recipes.index') }}"
                                                    class="nav-link {{ request()->is('admin/inventory/setup/recipes*') ? 'active' : '' }}">
                                                    <i class="far fa-dot-circle nav-icon"></i>
                                                    <p>Recipes Manage<i class="fas right fa-solid fa-plus add-new p-1"
                                                            add-new="{{ route('recipes.create') }}"></i></p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(168) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('production-plans.index') }}"
                                        class="nav-link {{ request()->is('admin/inventory/production-plans*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Production Plan <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('production-plans.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(172) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('purchase-requisitions.index') }}"
                                        class="nav-link {{ request()->is('admin/inventory/purchase-requisitions*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Purchase Requision <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('purchase-requisitions.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(41) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('purchases.index') }}"
                                        class="nav-link {{ request()->is('admin/inventory/purchases*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Purchases <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('purchases.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if ($authorization->hasMenuAccess(49) || (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('issue-items.index') }}"
                                        class="nav-link {{ request()->is('admin/inventory/issue-items*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Issue Items <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('issue-items.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(68) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('payments.index') }}"
                                        class="nav-link {{ request()->is('admin/inventory/payments*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Payments <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('payments.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif --}}
                @if (
                    $authorization->hasMenuAccess(77) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/expense*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/expense*') ? 'active' : '' }}">
                            <i class="nav-icon fa-regular fa-credit-card"></i>
                            <p>Expense <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $authorization->hasMenuAccess(78) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('expense-categories.index') }}"
                                        class="nav-link {{ request()->is('admin/expense/expense-categories*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Expense Category <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('expense-categories.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(79) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('expense-heads.index') }}"
                                        class="nav-link {{ request()->is('admin/expense/expense-heads*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Expense Head <i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('expense-heads.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(80) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('expenses.index') }}"
                                        class="nav-link {{ request()->is('admin/expense/expenses*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Expense Manage<i class="fas right fa-solid fa-plus add-new p-1"
                                                add-new="{{ route('expenses.create') }}"></i></p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(81) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('expenses.reports') }}"
                                        class="nav-link {{ request()->is('admin/expense/reports*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Expense Reports</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (
                    $authorization->hasMenuAccess(81) ||
                        (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                    <li class="nav-item {{ request()->is('admin/reports*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('admin/reports*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-file-invoice"></i>
                            <p>Reports <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if (
                                $authorization->hasMenuAccess(108) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('reports.vendor-ledgers') }}"
                                        class="nav-link {{ request()->is('admin/reports/vendor-ledgers*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Vendor Ledgers</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(176) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('reports.purchase') }}"
                                        class="nav-link {{ request()->is('admin/reports/purchase*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Purchase Report</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(177) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('reports.sales') }}"
                                        class="nav-link {{ request()->is('admin/reports/sales*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Sales Report</p>
                                    </a>
                                </li>
                            @endif
                            @if (
                                $authorization->hasMenuAccess(109) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('reports.stocks') }}"
                                        class="nav-link {{ request()->is('admin/reports/stocks*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Stock Report</p>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (
                                $authorization->hasMenuAccess(110) ||
                                    (Auth::guard('admin')->user()->type == 1 && Auth::guard('admin')->user()->is_client == 1))
                                <li class="nav-item">
                                    <a href="{{ route('reports.collections') }}"
                                        class="nav-link {{ request()->is('admin/reports/collections*') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Collections Report</p>
                                    </a>
                                </li>
                            @endif --}}
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>
<aside class="control-sidebar control-sidebar-dark"></aside>
