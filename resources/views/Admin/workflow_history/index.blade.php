@extends('Admin.layout.master')

@section('title', 'إدارة سجل سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_history')
    @include('Admin._components.resource-index')
@endsection
