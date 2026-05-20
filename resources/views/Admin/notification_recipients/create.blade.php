@extends('Admin.layout.master')

@section('title', 'إضافة مستلمو الإشعارات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'notification_recipients')
    @include('Admin._components.resource-form')
@endsection
