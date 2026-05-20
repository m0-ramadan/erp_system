@php
    $config = $qwResourceMap[$resourceKey];
    $routePrefix = $config['route'];
    $isEdit = isset($item) && $item;
    $formAction = $isEdit && Route::has($routePrefix . '.update') ? route($routePrefix . '.update', $item->id) : (Route::has($routePrefix . '.store') ? route($routePrefix . '.store') : url()->current());
@endphp
<div class="container-xxl flex-grow-1 container-p-y qw-page">
    @include('Admin._components.alerts')
    <div class="qw-hero">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative">
            <div>
                <h1>{{ $isEdit ? 'تعديل' : 'إضافة' }} {{ $config['title'] }}</h1>
                <p>املأ الحقول المطلوبة بدقة ثم اضغط حفظ.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                @if(Route::has($routePrefix . '.index'))
                    <a class="btn btn-light" href="{{ route($routePrefix . '.index') }}"><i class="ti ti-arrow-right me-1"></i> رجوع للقائمة</a>
                @endif
                <div class="qw-icon"><i class="ti ti-edit"></i></div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ $formAction }}" enctype="multipart/form-data">
        @csrf
        @if($isEdit) @method('PUT') @endif
        <div class="qw-card">
            <div class="qw-card-header">
                <h5 class="qw-section-title"><i class="ti ti-forms"></i> البيانات الأساسية</h5>
                <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> حفظ</button>
            </div>
            <div class="qw-card-body">
                <div class="qw-form-grid">
                    @foreach($config['form'] as $field)
                        @php
                            $fc = $config['fields'][$field] ?? ['label' => $field, 'type' => 'text'];
                            $type = $fc['type'] ?? 'text';
                            $value = old($field, $isEdit ? data_get($item, $field) : '');
                            if ($value instanceof \Carbon\CarbonInterface) { $value = $type === 'date' ? $value->format('Y-m-d') : $value->format('Y-m-d\TH:i'); }
                            $span = in_array($type, ['textarea']) ? 'span-2' : '';
                        @endphp
                        <div class="{{ $span }}">
                            <label class="qw-label" for="field_{{ $field }}">{{ $fc['label'] ?? $field }}</label>
                            @if($type === 'textarea')
                                <textarea id="field_{{ $field }}" name="{{ $field }}" rows="4" class="form-control qw-input">{{ is_array($value) || is_object($value) ? json_encode($value, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) : $value }}</textarea>
                            @elseif($type === 'select')
                                <select id="field_{{ $field }}" name="{{ $field }}" class="form-select qw-input">
                                    <option value="">اختر...</option>
                                    @foreach(($fc['options'] ?? []) as $optValue => $optLabel)
                                        <option value="{{ $optValue }}" @selected((string)$value === (string)$optValue)>{{ $optLabel }}</option>
                                    @endforeach
                                </select>
                            @elseif($type === 'relation')
                                @php
                                    $modelClass = $fc['model'] ?? null;
                                    $labelColumn = $fc['option_label'] ?? 'name';
                                    $records = collect();
                                    if ($modelClass && class_exists($modelClass)) {
                                        try { $records = $modelClass::query()->limit(500)->get(); } catch (\Throwable $e) { $records = collect(); }
                                    }
                                @endphp
                                <select id="field_{{ $field }}" name="{{ $field }}" class="form-select qw-input">
                                    <option value="">اختر...</option>
                                    @foreach($records as $record)
                                        <option value="{{ $record->id }}" @selected((string)$value === (string)$record->id)>#{{ $record->id }} - {{ data_get($record, $labelColumn) ?? $record->id }}</option>
                                    @endforeach
                                </select>
                            @elseif($type === 'boolean')
                                <select id="field_{{ $field }}" name="{{ $field }}" class="form-select qw-input">
                                    <option value="0" @selected((string)$value === '0')>لا</option>
                                    <option value="1" @selected((string)$value === '1' || $value === true)>نعم</option>
                                </select>
                            @elseif(in_array($type, ['file', 'image', 'camera']))
                                @php
                                    $accept = $fc['accept'] ?? ($type === 'image' || $type === 'camera' ? 'image/*' : '*/*');
                                    $capture = $fc['capture'] ?? ($type === 'camera' ? 'environment' : null);
                                @endphp
                                <div class="app-file-shell">
                                    <input
                                        id="field_{{ $field }}"
                                        name="{{ $field }}"
                                        type="file"
                                        class="form-control qw-input d-none"
                                        data-app-file
                                        accept="{{ $accept }}"
                                        @if($capture) capture="{{ $capture }}" @endif
                                    >
                                    <button type="button" class="app-file-trigger" data-file-browse>
                                        <span>{{ $fc['label'] ?? $field }}</span>
                                        <small>اختيار من الجهاز</small>
                                    </button>
                                    <div class="app-file-inline-actions">
                                        <button type="button" class="btn btn-sm btn-outline-primary" data-file-browse>استعراض الملفات</button>
                                        @if(in_array($type, ['image', 'camera']))
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-file-capture>فتح الكاميرا</button>
                                        @endif
                                    </div>
                                    <div class="app-file-name" data-file-name></div>
                                </div>
                            @else
                                <input id="field_{{ $field }}" name="{{ $field }}" type="{{ $type === 'datetime' ? 'datetime-local' : $type }}" value="{{ $value }}" class="form-control qw-input" @if($type === 'number') step="any" @endif>
                            @endif
                            @error($field)<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="qw-card-body border-top d-flex gap-2 justify-content-end">
                @if(Route::has($routePrefix . '.index'))
                    <a class="btn btn-label-secondary" href="{{ route($routePrefix . '.index') }}">إلغاء</a>
                @endif
                <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> حفظ البيانات</button>
            </div>
        </div>
    </form>
</div>
