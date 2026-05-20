@extends('Admin.layout.master')

@section('title', 'عرض ملفات الطلب')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'request_files')
    @include('Admin._components.resource-show')
@endsection
