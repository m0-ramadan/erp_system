@extends('Admin.layout.master')

@section('title', 'عرض الشحنات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'dispatches')
    @include('Admin._components.resource-show')
@endsection
