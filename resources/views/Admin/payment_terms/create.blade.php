@extends('Admin.layout.master')

@section('title', 'إضافة شروط الدفع')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'payment_terms')
    @include('Admin._components.resource-form')
@endsection
