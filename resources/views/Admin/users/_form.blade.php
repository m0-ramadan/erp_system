@php
    $isEdit = isset($item) && $item;
    $formAction = $isEdit ? route('admin.users.update', $item->id) : route('admin.users.store');
@endphp

<div class="container-xxl flex-grow-1 container-p-y qw-page">
    @include('Admin._components.alerts')

    <div class="qw-hero">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 position-relative">
            <div>
                <h1>{{ $isEdit ? 'تعديل المستخدم' : 'إضافة مستخدم' }}</h1>
                <p>تأكد من اختيار الدور لأن صلاحيات لوحة التحكم تعتمد عليه مباشرة.</p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a class="btn btn-light" href="{{ route('admin.users.index') }}"><i class="ti ti-arrow-right me-1"></i> رجوع للقائمة</a>
                <div class="qw-icon"><i class="ti ti-user-edit"></i></div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ $formAction }}">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="qw-card">
            <div class="qw-card-header">
                <h5 class="qw-section-title"><i class="ti ti-forms"></i> البيانات الأساسية</h5>
                <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> حفظ</button>
            </div>
            <div class="qw-card-body">
                <div class="qw-form-grid">
                    <div>
                        <label class="qw-label" for="employee_code">كود الموظف</label>
                        <input id="employee_code" name="employee_code" type="text" value="{{ old('employee_code', $item->employee_code ?? '') }}" class="form-control qw-input" placeholder="تلقائي..." readonly>
                        @error('employee_code')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="name">الاسم</label>
                        <input id="name" name="name" type="text" value="{{ old('name', $item->name ?? '') }}" class="form-control qw-input" required>
                        @error('name')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="email">البريد الإلكتروني</label>
                        <input id="email" name="email" type="email" value="{{ old('email', $item->email ?? '') }}" class="form-control qw-input" required>
                        @error('email')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="phone">الهاتف</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone', $item->phone ?? '') }}" class="form-control qw-input">
                        @error('phone')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="password">كلمة المرور</label>
                        <input id="password" name="password" type="password" class="form-control qw-input" @if(!$isEdit) required @endif>
                        <small class="text-muted d-block mt-1">
                            {{ $isEdit ? 'اتركها فارغة للاحتفاظ بكلمة المرور الحالية.' : 'يجب أن تكون 6 أحرف على الأقل.' }}
                        </small>
                        @error('password')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="role_id">الدور</label>
                        <select id="role_id" name="role_id" class="form-select qw-input" required>
                            <option value="">اختر الدور...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @selected((string) $selectedRoleId === (string) $role->id)>
                                    {{ $role->name }} ({{ $role->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="department_id">القسم</label>
                        <select id="department_id" name="department_id" class="form-select qw-input">
                            <option value="">اختر القسم...</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" @selected((string) old('department_id', $item->department_id ?? '') === (string) $department->id)>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="manager_user_id">المدير المباشر</label>
                        <select id="manager_user_id" name="manager_user_id" class="form-select qw-input">
                            <option value="">اختر المدير...</option>
                            @foreach($managers as $manager)
                                <option value="{{ $manager->id }}" @selected((string) old('manager_user_id', $item->manager_user_id ?? '') === (string) $manager->id)>
                                    {{ $manager->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('manager_user_id')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>

                    <div>
                        <label class="qw-label" for="is_active">نشط</label>
                        <select id="is_active" name="is_active" class="form-select qw-input">
                            @php($isActive = old('is_active', isset($item) ? (int) $item->is_active : 1))
                            <option value="1" @selected((string) $isActive === '1')>نعم</option>
                            <option value="0" @selected((string) $isActive === '0')>لا</option>
                        </select>
                        @error('is_active')<small class="text-danger d-block mt-1">{{ $message }}</small>@enderror
                    </div>
                </div>
            </div>
            <div class="qw-card-body border-top d-flex gap-2 justify-content-end">
                <a class="btn btn-label-secondary" href="{{ route('admin.users.index') }}">إلغاء</a>
                <button class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i> حفظ البيانات</button>
            </div>
        </div>
    </form>
</div>
