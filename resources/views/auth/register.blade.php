@extends('auth.layout')

@section('title', 'إنشاء حساب جديد')

@section('content')
    <div class="brand">ERP</div>
    <h1>إنشاء حساب جديد</h1>
    <p class="subtitle">
        أنشئ حسابك وحدد نوعه من الخيارات المسموح بها فقط.
        @if($includeAdmin)
            يمكنك أيضًا إنشاء أول حساب مسؤول للنظام إذا لم يكن هناك مستخدمون بعد.
        @endif
    </p>

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="field">
            <label for="name">الاسم الكامل</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="field">
            <label for="phone">رقم الهاتف</label>
            <input id="phone" type="text" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="field">
            <label for="role_code">نوع الحساب</label>
            <select id="role_code" name="role_code" required>
                <option value="">اختر نوع الحساب</option>
                @foreach($roles as $role)
                    <option value="{{ $role->code }}" @selected(old('role_code') === $role->code)>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            <div class="hint">المتاح من الصفحة العامة: مندوب مبيعات أو مصمم، ويظهر خيار المسؤول فقط عند إعداد النظام لأول مرة.</div>
            @error('role_code')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="field">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required>
            <div class="hint">8 أحرف على الأقل.</div>
            @error('password')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="field">
            <label for="password_confirmation">تأكيد كلمة المرور</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
        </div>

        <button class="button" type="submit">إنشاء الحساب والبدء</button>
    </form>

    <div class="links">
        <a href="{{ route('login') }}">لديك حساب بالفعل؟ تسجيل الدخول</a>
    </div>
@endsection
