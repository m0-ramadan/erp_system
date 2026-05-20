@extends('Admin.layout.master')

@section('title', 'تعديل إصدارات عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotation_versions')
    @include('Admin._components.resource-form')
@endsection
