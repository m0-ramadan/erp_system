@extends('Admin.layout.master')

@section('title', 'إضافة الإشعارات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'notifications')
    @include('Admin._components.resource-form')
@endsection
