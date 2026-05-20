<!doctype html>
<html lang="ar" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="rtl"
      data-theme="theme-default" data-assets-path="{{ asset('dashboard/assets') }}/"
      data-template="vertical-menu-template-no-customizer">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#5f63f2">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="ERP">
    <meta name="application-name" content="ERP">
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <link rel="icon" href="{{ asset('icons/app-icon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('icons/app-icon.svg') }}">
    <title>@yield('title', 'لوحة الإدارة')</title>
    @include('Admin.layout.css')
    @include('Admin.layout.app-shell-style')
    @yield('css')
</head>
<body class="app-shell">
<div class="app-splash" id="appSplash" aria-hidden="true">
    <div class="app-splash-card">
        <div class="app-splash-logo">ERP</div>
        <h2>{{ config('app.name', 'ERP') }}</h2>
        <p>جاري تجهيز لوحة التحكم بتجربة موبايل حديثة.</p>
        <div class="app-loader"></div>
    </div>
</div>

<div class="app-page-loader" id="appPageLoader" aria-hidden="true">
    <span class="dot"></span>
    <strong>جاري فتح الصفحة...</strong>
</div>

<div class="app-install-banner" id="appInstallBanner" aria-hidden="true">
    <div class="meta">
        <strong>تثبيت التطبيق</strong>
        <span>أضف لوحة التحكم إلى شاشة الهاتف الرئيسية.</span>
    </div>
    <div class="actions">
        <button class="btn btn-sm btn-primary" type="button" id="appInstallAction">تثبيت</button>
        <button class="btn btn-sm btn-label-secondary" type="button" id="appInstallDismiss">لاحقًا</button>
    </div>
</div>

<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        @include('Admin.layout.sidebar')
        <div class="layout-page">
            @include('Admin.layout.nav')
            <div class="content-wrapper">
                @yield('content')
                @include('Admin.layout.footer')
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>
    <div class="drag-target"></div>
</div>
@include('Admin.layout.mobile-nav')

<form id="form_action_delete" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>

@include('Admin.layout.js')
@yield('js')
</body>
</html>
