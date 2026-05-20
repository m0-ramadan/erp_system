@php
    $config = $qwResourceMap[$resourceKey];
    $routePrefix = $config['route'];
    $tableFields = $config['table'];
@endphp
<div class="container-xxl flex-grow-1 container-p-y qw-page">
    @include('Admin._components.alerts')

    <div class="qw-hero">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative">
            <div>
                <h1>{{ $config['title'] }}</h1>
                <p>إدارة كاملة للبيانات مع بحث، فلاتر، متابعة، وتحديث سريع.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                @if(Route::has($routePrefix . '.create'))
                    <a class="btn btn-light" href="{{ route($routePrefix . '.create') }}">
                        <i class="ti ti-plus me-1"></i> إضافة جديد
                    </a>
                @endif
                <div class="qw-icon"><i class="{{ $config['icon'] ?? 'ti ti-table' }}"></i></div>
            </div>
        </div>
    </div>

    <div class="qw-stats-grid">
        <div class="qw-stat"><div class="label">إجمالي السجلات</div><div class="number">{{ number_format($stats['total'] ?? $items->total() ?? 0) }}</div></div>
        @if(!empty($stats['by_status']))
            @foreach(array_slice($stats['by_status'], 0, 3, true) as $status => $count)
                <div class="qw-stat"><div class="label">{{ $qwHuman($status) }}</div><div class="number">{{ number_format($count) }}</div></div>
            @endforeach
        @endif
    </div>

    <div class="qw-card">
        <div class="qw-card-header">
            <h5 class="qw-section-title"><i class="ti ti-filter"></i> البحث والفلترة</h5>
            <a class="btn btn-sm btn-label-secondary" href="{{ Route::has($routePrefix . '.index') ? route($routePrefix . '.index') : url()->current() }}">مسح الفلاتر</a>
        </div>
        <div class="qw-card-body">
            <form method="GET" action="{{ Route::has($routePrefix . '.index') ? route($routePrefix . '.index') : url()->current() }}">
                <div class="qw-filter-grid">
                    <div>
                        <label class="qw-label">بحث</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control qw-input" placeholder="ابحث بالاسم أو الكود أو الرقم">
                    </div>
                    <div>
                        <label class="qw-label">من تاريخ</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}" class="form-control qw-input">
                    </div>
                    <div>
                        <label class="qw-label">إلى تاريخ</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}" class="form-control qw-input">
                    </div>
                    <div>
                        <label class="qw-label">عدد النتائج</label>
                        <select name="per_page" class="form-select qw-input">
                            @foreach([10,15,25,50,100] as $n)
                                <option value="{{ $n }}" @selected((int)request('per_page',15)===$n)>{{ $n }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary"><i class="ti ti-search me-1"></i> بحث</button>
                </div>
            </form>
        </div>
    </div>

    <div class="qw-card">
        <div class="qw-card-header">
            <h5 class="qw-section-title"><i class="ti ti-list-details"></i> قائمة {{ $config['title'] }}</h5>
            <span class="text-muted small">{{ $items->total() ?? 0 }} سجل</span>
        </div>
        <div class="qw-table-wrap">
            <table class="table qw-table">
                <thead>
                <tr>
                    <th>#</th>
                    @foreach($tableFields as $field)
                        <th>{{ $config['fields'][$field]['label'] ?? $field }}</th>
                    @endforeach
                    <th class="text-end">الإجراءات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($items as $item)
                    <tr>
                        <td class="fw-bold">{{ $item->id }}</td>
                        @foreach($tableFields as $field)
                            @php
                                $fieldConfig = $config['fields'][$field] ?? [];
                                $raw = data_get($item, $field);
                                $value = $qwValue($item, $field, $fieldConfig);
                            @endphp
                            <td>
                                @if(in_array($field, ['status','decision','result','task_status','priority','delivery_status','notification_type','reminder_type','response','feasibility_status','plan_status','step_type','customer_type','request_source','completeness_status','version_reason','cost_type','log_type','entity_type','related_entity_type']))
                                    <span class="qw-badge {{ $qwBadgeClass($raw) }}">{{ $value }}</span>
                                @elseif(($fieldConfig['type'] ?? null) === 'boolean')
                                    <span class="qw-badge {{ $raw ? 'success' : 'danger' }}">{{ $value }}</span>
                                @else
                                    {{ \Illuminate\Support\Str::limit(strip_tags($value), 60) }}
                                @endif
                            </td>
                        @endforeach
                        <td>
                            <div class="qw-actions">
                                @if(Route::has($routePrefix . '.show'))
                                    <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-sm btn-icon btn-label-info" title="عرض"><i class="ti ti-eye"></i></a>
                                @endif
                                @if(Route::has($routePrefix . '.edit'))
                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-sm btn-icon btn-label-primary" title="تعديل"><i class="ti ti-edit"></i></a>
                                @endif
                                @if(Route::has($routePrefix . '.destroy'))
                                    <button type="button" class="btn btn-sm btn-icon btn-label-danger" data-delete-url="{{ route($routePrefix . '.destroy', $item->id) }}" data-delete-title="حذف السجل #{{ $item->id }}؟"><i class="ti ti-trash"></i></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="{{ count($tableFields)+2 }}"><div class="qw-empty"><i class="ti ti-database-off d-block"></i> لا توجد بيانات حالياً</div></td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($items, 'linkCollection'))
            <div class="qw-card-body border-top">
                @include('Admin._components.pagination', ['paginator' => $items])
            </div>
        @endif
    </div>
</div>
