@extends('Admin.layout.master')

@section('title', 'عرض بنود الفواتير')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'invoice_items')
    @include('Admin._components.resource-show')
@endsection
