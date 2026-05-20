@extends('Admin.layout.master')

@section('title', 'عرض سجلات الإنتاج')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'production_logs')
    @include('Admin._components.resource-show')
@endsection
