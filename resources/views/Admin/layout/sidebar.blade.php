@php
    $user = auth()->user();

    $menu = [
        [
            'type' => 'link',
            'label' => 'الرئيسية',
            'icon' => 'ti ti-home',
            'route' => 'admin.dashboard',
            'patterns' => ['admin.dashboard', 'admin.index'],
            'permission' => 'dashboard.access',
        ],
        [
            'type' => 'group',
            'label' => 'الإعدادات الأساسية',
            'icon' => 'ti ti-settings',
            'patterns' => ['admin.departments.*', 'admin.roles.*', 'admin.permissions.*', 'admin.users.*', 'admin.currencies.*', 'admin.payment-terms.*', 'admin.file-types.*'],
            'items' => [
                ['label' => 'الأقسام', 'route' => 'admin.departments.index', 'patterns' => ['admin.departments.*'], 'permission' => 'departments.access'],
                ['label' => 'الأدوار', 'route' => 'admin.roles.index', 'patterns' => ['admin.roles.*'], 'permission' => 'roles.access'],
                ['label' => 'الصلاحيات', 'route' => 'admin.permissions.index', 'patterns' => ['admin.permissions.*'], 'permission' => 'permissions.access'],
                ['label' => 'المستخدمين', 'route' => 'admin.users.index', 'patterns' => ['admin.users.*'], 'permission' => 'users.access'],
                ['label' => 'العملات', 'route' => 'admin.currencies.index', 'patterns' => ['admin.currencies.*'], 'permission' => 'currencies.access'],
                ['label' => 'شروط الدفع', 'route' => 'admin.payment-terms.index', 'patterns' => ['admin.payment-terms.*'], 'permission' => 'payment-terms.access'],
                ['label' => 'أنواع الملفات', 'route' => 'admin.file-types.index', 'patterns' => ['admin.file-types.*'], 'permission' => 'file-types.access'],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'العملاء والمنتجات',
            'icon' => 'ti ti-users-group',
            'patterns' => ['admin.customers.*', 'admin.customer-contacts.*', 'admin.products.*', 'admin.product-specs.*'],
            'items' => [
                ['label' => 'العملاء', 'route' => 'admin.customers.index', 'patterns' => ['admin.customers.*'], 'permission' => 'customers.access'],
                ['label' => 'جهات الاتصال', 'route' => 'admin.customer-contacts.index', 'patterns' => ['admin.customer-contacts.*'], 'permission' => 'customer-contacts.access'],
                ['label' => 'المنتجات', 'route' => 'admin.products.index', 'patterns' => ['admin.products.*'], 'permission' => 'products.access'],
                ['label' => 'مواصفات المنتجات', 'route' => 'admin.product-specs.index', 'patterns' => ['admin.product-specs.*'], 'permission' => 'product-specs.access'],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'سير العمل',
            'icon' => 'ti ti-route',
            'patterns' => ['admin.workflow-steps.*', 'admin.workflow-transitions.*', 'admin.workflow-instances.*', 'admin.workflow-tasks.*', 'admin.workflow-history.*'],
            'items' => [
                ['label' => 'خطوات سير العمل', 'route' => 'admin.workflow-steps.index', 'patterns' => ['admin.workflow-steps.*'], 'permission' => 'workflow-steps.access'],
                ['label' => 'انتقالات سير العمل', 'route' => 'admin.workflow-transitions.index', 'patterns' => ['admin.workflow-transitions.*'], 'permission' => 'workflow-transitions.access'],
                ['label' => 'حالات سير العمل', 'route' => 'admin.workflow-instances.index', 'patterns' => ['admin.workflow-instances.*'], 'permission' => 'workflow-instances.access'],
                ['label' => 'مهام سير العمل', 'route' => 'admin.workflow-tasks.index', 'patterns' => ['admin.workflow-tasks.*'], 'permission' => 'workflow-tasks.access'],
                ['label' => 'سجل سير العمل', 'route' => 'admin.workflow-history.index', 'patterns' => ['admin.workflow-history.*'], 'permission' => 'workflow-history.access'],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'عروض الأسعار',
            'icon' => 'ti ti-file-invoice',
            'patterns' => ['admin.quote-requests.*', 'admin.quote-request-items.*', 'admin.request-files.*', 'admin.clarifications.*', 'admin.cost-estimations.*', 'admin.cost-estimation-items.*', 'admin.design-reviews.*', 'admin.accounts-reviews.*', 'admin.management-approvals.*'],
            'items' => [
                ['label' => 'طلبات عروض الأسعار', 'route' => 'admin.quote-requests.index', 'patterns' => ['admin.quote-requests.*'], 'permission' => 'quote-requests.access'],
                ['label' => 'بنود طلب العرض', 'route' => 'admin.quote-request-items.index', 'patterns' => ['admin.quote-request-items.*'], 'permission' => 'quote-request-items.access'],
                ['label' => 'ملفات الطلبات', 'route' => 'admin.request-files.index', 'patterns' => ['admin.request-files.*'], 'permission' => 'request-files.access'],
                ['label' => 'التوضيحات', 'route' => 'admin.clarifications.index', 'patterns' => ['admin.clarifications.*'], 'permission' => 'clarifications.access'],
                ['label' => 'تقديرات التكلفة', 'route' => 'admin.cost-estimations.index', 'patterns' => ['admin.cost-estimations.*'], 'permission' => 'cost-estimations.access'],
                ['label' => 'بنود التكلفة', 'route' => 'admin.cost-estimation-items.index', 'patterns' => ['admin.cost-estimation-items.*'], 'permission' => 'cost-estimation-items.access'],
                ['label' => 'مراجعات التصميم', 'route' => 'admin.design-reviews.index', 'patterns' => ['admin.design-reviews.*'], 'permission' => 'design-reviews.access'],
                ['label' => 'مراجعات الحسابات', 'route' => 'admin.accounts-reviews.index', 'patterns' => ['admin.accounts-reviews.*'], 'permission' => 'accounts-reviews.access'],
                ['label' => 'اعتمادات الإدارة', 'route' => 'admin.management-approvals.index', 'patterns' => ['admin.management-approvals.*'], 'permission' => 'management-approvals.access'],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'العروض والردود',
            'icon' => 'ti ti-file-analytics',
            'patterns' => ['admin.quotations.*', 'admin.quotation-versions.*', 'admin.quotation-items.*', 'admin.quotation-files.*', 'admin.customer-responses.*'],
            'items' => [
                ['label' => 'عروض الأسعار', 'route' => 'admin.quotations.index', 'patterns' => ['admin.quotations.*'], 'permission' => 'quotations.access'],
                ['label' => 'إصدارات العروض', 'route' => 'admin.quotation-versions.index', 'patterns' => ['admin.quotation-versions.*'], 'permission' => 'quotation-versions.access'],
                ['label' => 'بنود العروض', 'route' => 'admin.quotation-items.index', 'patterns' => ['admin.quotation-items.*'], 'permission' => 'quotation-items.access'],
                ['label' => 'ملفات العروض', 'route' => 'admin.quotation-files.index', 'patterns' => ['admin.quotation-files.*'], 'permission' => 'quotation-files.access'],
                ['label' => 'ردود العملاء', 'route' => 'admin.customer-responses.index', 'patterns' => ['admin.customer-responses.*'], 'permission' => 'customer-responses.access'],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'البيع والإنتاج',
            'icon' => 'ti ti-building-factory-2',
            'patterns' => ['admin.sales-orders.*', 'admin.job-tickets.*', 'admin.production-plans.*', 'admin.production-logs.*', 'admin.quality-checks.*', 'admin.dispatches.*', 'admin.deliveries.*'],
            'items' => [
                ['label' => 'أوامر البيع', 'route' => 'admin.sales-orders.index', 'patterns' => ['admin.sales-orders.*'], 'permission' => 'sales-orders.access'],
                ['label' => 'تذاكر التشغيل', 'route' => 'admin.job-tickets.index', 'patterns' => ['admin.job-tickets.*'], 'permission' => 'job-tickets.access'],
                ['label' => 'خطط الإنتاج', 'route' => 'admin.production-plans.index', 'patterns' => ['admin.production-plans.*'], 'permission' => 'production-plans.access'],
                ['label' => 'سجلات الإنتاج', 'route' => 'admin.production-logs.index', 'patterns' => ['admin.production-logs.*'], 'permission' => 'production-logs.access'],
                ['label' => 'فحص الجودة', 'route' => 'admin.quality-checks.index', 'patterns' => ['admin.quality-checks.*'], 'permission' => 'quality-checks.access'],
                ['label' => 'الشحنات', 'route' => 'admin.dispatches.index', 'patterns' => ['admin.dispatches.*'], 'permission' => 'dispatches.access'],
                ['label' => 'التسليمات', 'route' => 'admin.deliveries.index', 'patterns' => ['admin.deliveries.*'], 'permission' => 'deliveries.access'],
            ],
        ],
        [
            'type' => 'group',
            'label' => 'الفواتير والمتابعة',
            'icon' => 'ti ti-bell-ringing',
            'patterns' => ['admin.invoices.*', 'admin.invoice-items.*', 'admin.reminders.*', 'admin.notifications.*', 'admin.notification-recipients.*', 'admin.audit-logs.*'],
            'items' => [
                ['label' => 'الفواتير', 'route' => 'admin.invoices.index', 'patterns' => ['admin.invoices.*'], 'permission' => 'invoices.access'],
                ['label' => 'بنود الفواتير', 'route' => 'admin.invoice-items.index', 'patterns' => ['admin.invoice-items.*'], 'permission' => 'invoice-items.access'],
                ['label' => 'التذكيرات', 'route' => 'admin.reminders.index', 'patterns' => ['admin.reminders.*'], 'permission' => 'reminders.access'],
                ['label' => 'الإشعارات', 'route' => 'admin.notifications.index', 'patterns' => ['admin.notifications.*'], 'permission' => 'notifications.access'],
                ['label' => 'مستلمو الإشعارات', 'route' => 'admin.notification-recipients.index', 'patterns' => ['admin.notification-recipients.*'], 'permission' => 'notification-recipients.access'],
                ['label' => 'سجل التدقيق', 'route' => 'admin.audit-logs.index', 'patterns' => ['admin.audit-logs.*'], 'permission' => 'audit-logs.access'],
            ],
        ],
    ];

    $canAccess = fn (string $permission) => $user?->hasPermission($permission) ?? false;
    $canAccessAny = fn (array $permissions) => $user?->hasAnyPermission($permissions) ?? false;
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin') }}" class="app-brand-link">
            <span class="app-brand-logo demo"><i class="ti ti-hexagon-letter-q text-primary" style="font-size:34px"></i></span>
            <span class="app-brand-text demo menu-text fw-bold" style="font-size:.95rem">{{ config('app.name', 'Workflow') }}</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto"><i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i><i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i></a>
    </div>
    <div class="menu-inner-shadow"></div>
    <ul class="menu-inner py-1">
        @foreach($menu as $entry)
            @if($entry['type'] === 'link' && $canAccess($entry['permission']))
                <li class="menu-item @if(request()->routeIs(...$entry['patterns'])) active @endif">
                    <a href="{{ Route::has($entry['route']) ? route($entry['route']) : '#' }}" class="menu-link">
                        <i class="menu-icon tf-icons {{ $entry['icon'] }}"></i>
                        <div>{{ $entry['label'] }}</div>
                    </a>
                </li>
            @elseif($entry['type'] === 'group' && $canAccessAny(collect($entry['items'])->pluck('permission')->all()))
                <li class="menu-item @if(request()->routeIs(...$entry['patterns'])) active open @endif">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons {{ $entry['icon'] }}"></i>
                        <div>{{ $entry['label'] }}</div>
                    </a>
                    <ul class="menu-sub">
                        @foreach($entry['items'] as $item)
                            @if($canAccess($item['permission']))
                                <li class="menu-item @if(request()->routeIs(...$item['patterns'])) active @endif">
                                    <a href="{{ Route::has($item['route']) ? route($item['route']) : '#' }}" class="menu-link">
                                        <div>{{ $item['label'] }}</div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</aside>
