@extends('Admin.layout.master')

@section('title', 'عرض الصلاحيات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'permissions')
    @include('Admin._components.resource-show')
@endsection
