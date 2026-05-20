@extends('Admin.layout.master')

@section('title', 'عرض الإشعارات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'notifications')
    @include('Admin._components.resource-show')
@endsection
