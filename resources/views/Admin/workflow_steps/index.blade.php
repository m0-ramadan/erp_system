@extends('Admin.layout.master')

@section('title', 'إدارة خطوات سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_steps')
    @include('Admin._components.resource-index')
@endsection
