@extends('Admin.layout.master')

@section('title', 'إدارة مراجعات التصميم')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'design_reviews')
    @include('Admin._components.resource-index')
@endsection
