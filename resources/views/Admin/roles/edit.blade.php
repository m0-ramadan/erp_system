@extends('Admin.layout.master')

@section('title', 'تعديل الأدوار')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'roles')
    @include('Admin._components.resource-form')
@endsection
