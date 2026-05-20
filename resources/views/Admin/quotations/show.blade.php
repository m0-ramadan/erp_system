@extends('Admin.layout.master')

@section('title', 'عرض عروض الأسعار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quotations')
    @include('Admin._components.resource-show')
@endsection
