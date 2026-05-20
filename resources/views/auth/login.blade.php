@extends('auth.layout')

@section('title', 'تسجيل الدخول')

@section('content')
    <div class="brand">ERP</div>
    <h1>تسجيل الدخول</h1>
    <p class="subtitle">استخدم بريدك الإلكتروني وكلمة المرور للوصول إلى لوحة النظام.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label for="email">البريد الإلكتروني</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <div class="field">
            <label for="password">كلمة المرور</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <ul class="errors"><li>{{ $message }}</li></ul>
            @enderror
        </div>

        <button class="button" type="submit">دخول إلى النظام</button>
    </form>

    <div class="links">
        <a href="{{ route('register') }}">إنشاء حساب جديد</a>
    </div>
@endsection
