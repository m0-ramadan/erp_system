@extends('Admin.layout.master')

@section('title', 'إضافة التذكيرات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'reminders')
    @include('Admin._components.resource-form')
@endsection
