@extends('Admin.layout.master')

@section('title', 'عرض حالات سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_instances')
    @include('Admin._components.resource-show')
@endsection
