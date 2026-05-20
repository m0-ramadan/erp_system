@extends('Admin.layout.master')

@section('title', 'تعديل سجل التدقيق')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'audit_logs')
    @include('Admin._components.resource-form')
@endsection
