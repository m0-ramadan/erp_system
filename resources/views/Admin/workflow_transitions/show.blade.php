@extends('Admin.layout.master')

@section('title', 'عرض انتقالات سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_transitions')
    @include('Admin._components.resource-show')
@endsection
