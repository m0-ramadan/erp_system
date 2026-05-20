@extends('Admin.layout.master')

@section('title', 'إضافة خطط الإنتاج')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'production_plans')
    @include('Admin._components.resource-form')
@endsection
