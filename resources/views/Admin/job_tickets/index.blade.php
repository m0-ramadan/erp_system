@extends('Admin.layout.master')

@section('title', 'إدارة تذاكر التشغيل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'job_tickets')
    @include('Admin._components.resource-index')
@endsection
