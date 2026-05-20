@extends('Admin.layout.master')

@section('title', 'عرض طلبات عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quote_requests')
    @include('Admin._components.resource-show')
@endsection
