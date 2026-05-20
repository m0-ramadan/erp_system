@extends('Admin.layout.master')

@section('title', 'تعديل طلبات عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quote_requests')
    @include('Admin._components.resource-form')
@endsection
