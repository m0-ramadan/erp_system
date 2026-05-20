@extends('Admin.layout.master')

@section('title', 'عرض الأدوار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'roles')
    @include('Admin._components.resource-show')
@endsection
