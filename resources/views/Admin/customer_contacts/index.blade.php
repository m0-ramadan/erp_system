@extends('Admin.layout.master')

@section('title', 'إدارة جهات اتصال العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customer_contacts')
    @include('Admin._components.resource-index')
@endsection
