@extends('Admin.layout.master')

@section('title', 'إدارة الأقسام')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'departments')
    @include('Admin._components.resource-index')
@endsection
