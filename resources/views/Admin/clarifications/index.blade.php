@extends('Admin.layout.master')

@section('title', 'إدارة الاستفسارات والتوضيحات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'clarifications')
    @include('Admin._components.resource-index')
@endsection
