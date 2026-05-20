@extends('Admin.layout.master')

@section('title', 'تعديل فحص الجودة')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'quality_checks')
    @include('Admin._components.resource-form')
@endsection
