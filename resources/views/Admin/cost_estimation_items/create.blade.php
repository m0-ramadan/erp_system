@extends('Admin.layout.master')

@section('title', 'إضافة بنود تقدير التكلفة')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'cost_estimation_items')
    @include('Admin._components.resource-form')
@endsection
