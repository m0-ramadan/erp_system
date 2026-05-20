@extends('Admin.layout.master')

@section('title', 'تعديل الإشعارات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'notifications')
    @include('Admin._components.resource-form')
@endsection
