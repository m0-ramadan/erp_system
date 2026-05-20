@extends('Admin.layout.master')

@section('title', 'عرض فحص الجودة')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quality_checks')
    @include('Admin._components.resource-show')
@endsection
