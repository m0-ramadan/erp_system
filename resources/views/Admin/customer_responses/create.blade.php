@extends('Admin.layout.master')

@section('title', 'إضافة ردود العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customer_responses')
    @include('Admin._components.resource-form')
@endsection
