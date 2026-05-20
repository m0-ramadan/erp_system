@extends('Admin.layout.master')

@section('title', 'تعديل أوامر البيع')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'sales_orders')
    @include('Admin._components.resource-form')
@endsection
