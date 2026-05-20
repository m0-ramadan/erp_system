@extends('Admin.layout.master')

@section('title', 'إضافة بنود الفواتير')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'invoice_items')
    @include('Admin._components.resource-form')
@endsection
