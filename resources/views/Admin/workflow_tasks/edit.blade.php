@extends('Admin.layout.master')

@section('title', 'تعديل مهام سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_tasks')
    @include('Admin._components.resource-form')
@endsection
