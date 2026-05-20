@extends('Admin.layout.master')

@section('title', 'لوحة التحكم')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y qw-page">
    <div class="qw-hero">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative">
            <div>
                <span class="qw-kicker"><i class="ti ti-device-mobile"></i> تجربة لوحة محسنة للموبايل</span>
                <h1>لوحة التحكم الرئيسية</h1>
                <p>نظرة شاملة على طلبات عروض الأسعار، الإنتاج، أوامر البيع، والفواتير.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a class="btn btn-light" href="{{ Route::has('admin.quote-requests.create') ? route('admin.quote-requests.create') : '#' }}"><i class="ti ti-plus me-1"></i> طلب جديد</a>
                <div class="qw-icon"><i class="ti ti-dashboard"></i></div>
            </div>
        </div>
    </div>

    <div class="qw-quick-actions">
        @permission('quote-requests.access')
            <a href="{{ route('admin.quote-requests.index') }}" class="qw-quick-action">
                <i class="ti ti-file-invoice"></i>
                <div><strong>طلبات العروض</strong><span>متابعة وفلترة سريعة</span></div>
            </a>
        @endpermission
        @permission('workflow-tasks.access')
            <a href="{{ route('admin.workflow-tasks.index') }}" class="qw-quick-action">
                <i class="ti ti-checklist"></i>
                <div><strong>المهام</strong><span>الوصول للمهام المفتوحة</span></div>
            </a>
        @endpermission
        @permission('quotations.access')
            <a href="{{ route('admin.quotations.index') }}" class="qw-quick-action">
                <i class="ti ti-file-analytics"></i>
                <div><strong>العروض</strong><span>الإصدارات والملفات</span></div>
            </a>
        @endpermission
        @permission('notifications.access')
            <a href="{{ route('admin.notifications.index') }}" class="qw-quick-action">
                <i class="ti ti-bell-ringing"></i>
                <div><strong>الإشعارات</strong><span>تنبيهات فورية داخل اللوحة</span></div>
            </a>
        @endpermission
    </div>

    <div class="qw-stats-grid">
        <div class="qw-stat"><div class="label">العملاء</div><div class="number">{{ number_format($stats['customers'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">طلبات عروض الأسعار</div><div class="number">{{ number_format($stats['quote_requests'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">عروض الأسعار</div><div class="number">{{ number_format($stats['quotations'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">أوامر البيع</div><div class="number">{{ number_format($stats['sales_orders'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">تذاكر التشغيل</div><div class="number">{{ number_format($stats['job_tickets'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">الفواتير</div><div class="number">{{ number_format($stats['invoices'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">المهام المفتوحة</div><div class="number">{{ number_format($stats['open_tasks'] ?? 0) }}</div></div>
        <div class="qw-stat"><div class="label">إجمالي المبيعات</div><div class="number">{{ number_format($stats['total_sales'] ?? 0, 2) }}</div></div>
    </div>

    <div class="row">
        <div class="col-xl-7">
            <div class="qw-card h-100">
                <div class="qw-card-header"><h5 class="qw-section-title"><i class="ti ti-file-description"></i> أحدث طلبات عروض الأسعار</h5></div>
                <div class="qw-table-wrap">
                    <table class="table qw-table">
                        <thead><tr><th>رقم الطلب</th><th>العميل</th><th>مسؤول المبيعات</th><th>الحالة</th><th>التاريخ</th></tr></thead>
                        <tbody>
                            @forelse($latestQuoteRequests ?? [] as $request)
                                <tr>
                                    <td class="fw-bold">{{ $request->request_no }}</td>
                                    <td>{{ $request->customer->company_name ?? '—' }}</td>
                                    <td>{{ $request->salesRep->name ?? '—' }}</td>
                                    <td><span class="qw-badge {{ $qwBadgeClass($request->status) }}">{{ $qwHuman($request->status) }}</span></td>
                                    <td>{{ optional($request->created_at)->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5"><div class="qw-empty"><i class="ti ti-database-off d-block"></i> لا توجد طلبات حالياً</div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="qw-card h-100">
                <div class="qw-card-header"><h5 class="qw-section-title"><i class="ti ti-checklist"></i> المهام المفتوحة</h5></div>
                <div class="qw-card-body">
                    <div class="qw-list-stack">
                        @forelse($openTasks ?? [] as $task)
                            <div class="qw-list-item">
                                <span class="qw-badge {{ $qwBadgeClass($task->task_status) }}">{{ $qwHuman($task->task_status) }}</span>
                                <div class="meta">
                                    <div>{{ $task->step->name ?? $task->step_code }}</div>
                                    <small class="text-muted">{{ $task->assignedUser->name ?? $task->assigned_role_code ?? 'غير مسند' }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="qw-empty"><i class="ti ti-circle-check d-block"></i> لا توجد مهام مفتوحة</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
