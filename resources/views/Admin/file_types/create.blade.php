@extends('Admin.layout.master')

@section('title', 'إضافة أنواع الملفات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'file_types')
    @include('Admin._components.resource-form')
@endsection
