@extends('Admin.layout.master')

@section('title', 'تعديل المستخدمين')

@section('css')
    @include('Admin._components.resource-style')
@endsection

@section('content')
    @include('Admin.users._form')
@endsection
