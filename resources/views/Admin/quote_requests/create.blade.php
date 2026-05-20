@extends('Admin.layout.master')

@section('title', 'إضافة طلبات عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quote_requests')
    @include('Admin._components.resource-form')
@endsection
