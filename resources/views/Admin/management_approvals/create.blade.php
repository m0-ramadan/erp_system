@extends('Admin.layout.master')

@section('title', 'إضافة اعتمادات الإدارة')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'management_approvals')
    @include('Admin._components.resource-form')
@endsection
