@extends('Admin.layout.master')

@section('title', 'تعديل الشحنات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'dispatches')
    @include('Admin._components.resource-form')
@endsection
