@extends('Admin.layout.master')

@section('title', 'إدارة سجل التدقيق')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'audit_logs')
    @include('Admin._components.resource-index')
@endsection
