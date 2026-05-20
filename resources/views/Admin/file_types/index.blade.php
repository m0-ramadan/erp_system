@extends('Admin.layout.master')

@section('title', 'إدارة أنواع الملفات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'file_types')
    @include('Admin._components.resource-index')
@endsection
