@extends('Admin.layout.master')

@section('title', 'إضافة المستخدمين')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @include('Admin.users._form')
@endsection
