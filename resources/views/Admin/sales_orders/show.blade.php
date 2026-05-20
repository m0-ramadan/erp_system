@extends('Admin.layout.master')

@section('title', 'عرض أوامر البيع')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'sales_orders')
    @include('Admin._components.resource-show')
@endsection
