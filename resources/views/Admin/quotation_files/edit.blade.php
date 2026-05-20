@extends('Admin.layout.master')

@section('title', 'تعديل ملفات عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotation_files')
    @include('Admin._components.resource-form')
@endsection
