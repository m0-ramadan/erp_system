@extends('Admin.layout.master')

@section('title', 'إضافة مراجعات التصميم')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'design_reviews')
    @include('Admin._components.resource-form')
@endsection
