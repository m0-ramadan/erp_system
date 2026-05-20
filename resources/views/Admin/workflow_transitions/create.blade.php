@extends('Admin.layout.master')

@section('title', 'إضافة انتقالات سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_transitions')
    @include('Admin._components.resource-form')
@endsection
