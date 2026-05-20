@extends('Admin.layout.master')

@section('title', 'إدارة عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotations')
    @include('Admin._components.resource-index')
@endsection
