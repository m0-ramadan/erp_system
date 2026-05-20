@extends('Admin.layout.master')

@section('title', 'إدارة الصلاحيات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'permissions')
    @include('Admin._components.resource-index')
@endsection
