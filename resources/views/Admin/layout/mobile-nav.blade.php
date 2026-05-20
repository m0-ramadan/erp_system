@php
    $mobileNavItems = array_filter([
        auth()->user()?->hasPermission('dashboard.access') ? [
            'label' => 'الرئيسية',
            'icon' => 'ti ti-home',
            'route' => 'admin.dashboard',
            'patterns' => ['admin.dashboard', 'admin.index'],
        ] : null,
        auth()->user()?->hasPermission('quote-requests.access') ? [
            'label' => 'العروض',
            'icon' => 'ti ti-file-invoice',
            'route' => 'admin.quote-requests.index',
            'patterns' => ['admin.quote-requests.*', 'admin.quotations.*'],
        ] : null,
        auth()->user()?->hasPermission('workflow-tasks.access') ? [
            'label' => 'المهام',
            'icon' => 'ti ti-checklist',
            'route' => 'admin.workflow-tasks.index',
            'patterns' => ['admin.workflow-tasks.*', 'admin.workflow.open-tasks'],
        ] : null,
        auth()->user()?->hasPermission('notifications.access') ? [
            'label' => 'التنبيهات',
            'icon' => 'ti ti-bell-ringing',
            'route' => 'admin.notifications.index',
            'patterns' => ['admin.notifications.*'],
        ] : null,
    ]);
@endphp

@if($mobileNavItems !== [])
    <nav class="mobile-bottom-nav" aria-label="Mobile app navigation">
        @foreach(array_slice(array_values($mobileNavItems), 0, 4) as $item)
            <a href="{{ route($item['route']) }}" class="mobile-bottom-nav__item @if(request()->routeIs(...$item['patterns'])) is-active @endif">
                <i class="{{ $item['icon'] }}"></i>
                <span>{{ $item['label'] }}</span>
            </a>
        @endforeach
        <a href="javascript:void(0)" class="mobile-bottom-nav__item" data-app-menu-toggle>
            <i class="ti ti-layout-grid"></i>
            <span>المزيد</span>
        </a>
    </nav>
    <div class="mobile-safe-bottom"></div>
@endif
