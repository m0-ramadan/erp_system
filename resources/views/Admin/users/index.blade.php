@extends('Admin.layout.master')

@section('title', 'إدارة المستخدمين')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'users')
    @include('Admin._components.resource-index')
@endsection
