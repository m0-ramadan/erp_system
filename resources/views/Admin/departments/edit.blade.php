@extends('Admin.layout.master')

@section('title', 'تعديل الأقسام')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'departments')
    @include('Admin._components.resource-form')
@endsection
