@extends('Admin.layout.master')

@section('title', 'إدارة مواصفات المنتجات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'product_specs')
    @include('Admin._components.resource-index')
@endsection
