@extends('Admin.layout.master')

@section('title', 'إضافة التسليمات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'deliveries')
    @include('Admin._components.resource-form')
@endsection
