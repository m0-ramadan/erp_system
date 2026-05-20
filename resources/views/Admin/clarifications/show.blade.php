@extends('Admin.layout.master')

@section('title', 'عرض الاستفسارات والتوضيحات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'clarifications')
    @include('Admin._components.resource-show')
@endsection
