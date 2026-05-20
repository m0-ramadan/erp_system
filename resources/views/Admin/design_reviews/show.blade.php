@extends('Admin.layout.master')

@section('title', 'عرض مراجعات التصميم')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'design_reviews')
    @include('Admin._components.resource-show')
@endsection
