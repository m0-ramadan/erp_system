@extends('Admin.layout.master')

@section('title', 'عرض بنود عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotation_items')
    @include('Admin._components.resource-show')
@endsection
