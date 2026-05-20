@extends('Admin.layout.master')

@section('title', 'عرض ردود العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customer_responses')
    @include('Admin._components.resource-show')
@endsection
