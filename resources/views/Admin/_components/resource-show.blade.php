@php
    $config = $qwResourceMap[$resourceKey];
    $routePrefix = $config['route'];
@endphp
<div class="container-xxl flex-grow-1 container-p-y qw-page">
    @include('Admin._components.alerts')
    <div class="qw-hero">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative">
            <div>
                <h1>تفاصيل {{ $config['title'] }} #{{ $item->id }}</h1>
                <p>عرض كامل لكل بيانات السجل والحقول المرتبطة به.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                @if(Route::has($routePrefix . '.edit'))
                    <a class="btn btn-light" href="{{ route($routePrefix . '.edit', $item->id) }}"><i class="ti ti-edit me-1"></i> تعديل</a>
                @endif
                @if(Route::has($routePrefix . '.index'))
                    <a class="btn btn-outline-light" href="{{ route($routePrefix . '.index') }}"><i class="ti ti-list me-1"></i> القائمة</a>
                @endif
                <div class="qw-icon"><i class="ti ti-eye"></i></div>
            </div>
        </div>
    </div>

    <div class="qw-card">
        <div class="qw-card-header">
            <h5 class="qw-section-title"><i class="ti ti-info-circle"></i> بيانات السجل</h5>
        </div>
        <div class="qw-card-body">
            <div class="qw-detail-grid">
                @foreach($config['fields'] as $field => $fc)
                    @php
                        $raw = data_get($item, $field);
                        $value = $qwValue($item, $field, $fc);
                    @endphp
                    <div class="qw-detail">
                        <div class="label">{{ $fc['label'] ?? $field }}</div>
                        <div class="value">
                            @if(in_array($field, ['status','decision','result','task_status','priority','delivery_status','notification_type','reminder_type','response','feasibility_status','plan_status','step_type','customer_type','request_source','completeness_status','version_reason','cost_type','log_type','entity_type','related_entity_type']) || ($fc['type'] ?? null) === 'boolean')
                                <span class="qw-badge {{ $qwBadgeClass($raw) }}">{{ $value }}</span>
                            @else
                                {{ $value }}
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="qw-detail"><div class="label">تاريخ الإنشاء</div><div class="value">{{ optional($item->created_at)->format('Y-m-d H:i') ?? '—' }}</div></div>
                <div class="qw-detail"><div class="label">آخر تحديث</div><div class="value">{{ optional($item->updated_at)->format('Y-m-d H:i') ?? '—' }}</div></div>
            </div>
        </div>
    </div>
</div>
