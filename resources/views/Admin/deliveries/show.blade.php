@extends('Admin.layout.master')

@section('title', 'عرض التسليمات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'deliveries')
    @include('Admin._components.resource-show')
@endsection
