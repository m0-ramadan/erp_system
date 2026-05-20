@extends('Admin.layout.master')

@section('title', 'تعديل بنود طلب العرض')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quote_request_items')
    @include('Admin._components.resource-form')
@endsection
