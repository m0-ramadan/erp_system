@extends('Admin.layout.master')

@section('title', 'عرض خطط الإنتاج')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'production_plans')
    @include('Admin._components.resource-show')
@endsection
