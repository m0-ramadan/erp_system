@php
    $user = auth()->user();
    $initials = $user?->name ? mb_substr($user->name, 0, 1) : 'م';
@endphp
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center gap-2">
                <i class="ti ti-search text-muted"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="بحث سريع داخل النظام..." aria-label="بحث">
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            @permission('quote-requests.access')
                <li class="nav-item me-2 d-none d-md-block">
                    <a class="btn btn-sm btn-primary" href="{{ Route::has('admin.quote-requests.create') ? route('admin.quote-requests.create') : '#' }}">
                        <i class="ti ti-plus me-1"></i> طلب عرض جديد
                    </a>
                </li>
            @endpermission
            @if(Route::has('admin.logout'))
                <li class="nav-item me-2 d-none d-lg-block">
                    <a class="btn btn-sm btn-outline-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ti ti-logout me-1"></i> تسجيل الخروج
                    </a>
                </li>
            @endif
            @permission('notifications.access')
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-2">
                    <a class="nav-link dropdown-toggle hide-arrow" href="{{ Route::has('admin.notifications.index') ? route('admin.notifications.index') : '#' }}">
                        <i class="ti ti-bell ti-md"></i>
                    </a>
                </li>
            @endpermission
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <span class="avatar-initial rounded-circle bg-primary">{{ $initials }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <div class="dropdown-item">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online"><span class="avatar-initial rounded-circle bg-primary">{{ $initials }}</span></div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{ $user?->name ?? 'Admin' }}</span>
                                    <small class="text-muted">{{ $user?->email ?? config('app.name') }}</small>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><div class="dropdown-divider"></div></li>
                    <li>
                        @if(Route::has('admin.logout'))
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="ti ti-logout me-2 ti-sm"></i> تسجيل الخروج
                            </a>
                        @else
                            <a class="dropdown-item" href="#"><i class="ti ti-user me-2 ti-sm"></i> الحساب</a>
                        @endif
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    @if(Route::has('admin.logout'))
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">@csrf</form>
    @endif
</nav>
