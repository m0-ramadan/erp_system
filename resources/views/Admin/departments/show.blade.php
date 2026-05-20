@extends('Admin.layout.master')

@section('title', 'عرض الأقسام')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'departments')
    @include('Admin._components.resource-show')
@endsection
