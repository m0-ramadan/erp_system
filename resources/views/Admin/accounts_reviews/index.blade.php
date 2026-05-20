@extends('Admin.layout.master')

@section('title', 'إدارة مراجعات الحسابات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'accounts_reviews')
    @include('Admin._components.resource-index')
@endsection
