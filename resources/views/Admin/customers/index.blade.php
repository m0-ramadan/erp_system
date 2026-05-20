@extends('Admin.layout.master')

@section('title', 'إدارة العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customers')
    @include('Admin._components.resource-index')
@endsection
