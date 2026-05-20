@extends('Admin.layout.master')

@section('title', 'عرض سجل التدقيق')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'audit_logs')
    @include('Admin._components.resource-show')
@endsection
