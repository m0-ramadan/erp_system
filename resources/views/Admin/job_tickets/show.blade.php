@extends('Admin.layout.master')

@section('title', 'عرض تذاكر التشغيل')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'job_tickets')
    @include('Admin._components.resource-show')
@endsection
