@extends('Admin.layout.master')

@section('title', 'إدارة ردود العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customer_responses')
    @include('Admin._components.resource-index')
@endsection
