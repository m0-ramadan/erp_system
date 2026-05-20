@extends('Admin.layout.master')

@section('title', 'إضافة العملات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'currencies')
    @include('Admin._components.resource-form')
@endsection
