@extends('Admin.layout.master')

@section('title', 'إضافة سجلات الإنتاج')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'production_logs')
    @include('Admin._components.resource-form')
@endsection
