@extends('Admin.layout.master')

@section('title', 'إدارة الأدوار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'roles')
    @include('Admin._components.resource-index')
@endsection
