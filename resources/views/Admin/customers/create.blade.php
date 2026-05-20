@extends('Admin.layout.master')

@section('title', 'إضافة العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customers')
    @include('Admin._components.resource-form')
@endsection
