@extends('Admin.layout.master')

@section('title', 'إضافة الصلاحيات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'permissions')
    @include('Admin._components.resource-form')
@endsection
