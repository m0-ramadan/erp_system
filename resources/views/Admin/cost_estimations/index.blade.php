@extends('Admin.layout.master')

@section('title', 'إدارة تقديرات التكلفة')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'cost_estimations')
    @include('Admin._components.resource-index')
@endsection
