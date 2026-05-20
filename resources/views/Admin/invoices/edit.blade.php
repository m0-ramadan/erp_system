@extends('Admin.layout.master')

@section('title', 'تعديل الفواتير')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'invoices')
    @include('Admin._components.resource-form')
@endsection
