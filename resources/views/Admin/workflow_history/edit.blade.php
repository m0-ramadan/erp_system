@extends('Admin.layout.master')

@section('title', 'تعديل سجل سير العمل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'workflow_history')
    @include('Admin._components.resource-form')
@endsection
