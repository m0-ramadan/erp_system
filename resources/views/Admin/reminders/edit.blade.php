@extends('Admin.layout.master')

@section('title', 'تعديل التذكيرات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'reminders')
    @include('Admin._components.resource-form')
@endsection
