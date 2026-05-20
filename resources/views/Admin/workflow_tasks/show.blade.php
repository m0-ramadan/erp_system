@extends('Admin.layout.master')

@section('title', 'عرض مهام سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_tasks')
    @include('Admin._components.resource-show')
@endsection
