@extends('Admin.layout.master')

@section('title', 'تعديل المستخدمين')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'users')
    @include('Admin._components.resource-form')
@endsection
