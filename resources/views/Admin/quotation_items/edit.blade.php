@extends('Admin.layout.master')

@section('title', 'تعديل بنود عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotation_items')
    @include('Admin._components.resource-form')
@endsection
