@extends('Admin.layout.master')

@section('title', 'تعديل تقديرات التكلفة')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'cost_estimations')
    @include('Admin._components.resource-form')
@endsection
