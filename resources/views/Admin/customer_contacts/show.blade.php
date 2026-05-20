@extends('Admin.layout.master')

@section('title', 'عرض جهات اتصال العملاء')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @php($resourceKey = 'customer_contacts')
    @include('Admin._components.resource-show')
@endsection
