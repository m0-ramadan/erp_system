@extends('Admin.layout.master')

@section('title', 'إدارة إصدارات عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotation_versions')
    @include('Admin._components.resource-index')
@endsection
