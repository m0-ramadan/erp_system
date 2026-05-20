@extends('Admin.layout.master')

@section('title', 'عرض العملات')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'currencies')
    @include('Admin._components.resource-show')
@endsection
