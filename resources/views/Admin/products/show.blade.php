@extends('Admin.layout.master')

@section('title', 'عرض المنتجات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'products')
    @include('Admin._components.resource-show')
@endsection
