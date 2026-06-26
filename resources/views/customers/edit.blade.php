@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')
<x-page-header title="Edit Customer" subtitle="{{ $customer->name }}" />
@include('customers._form', ['action' => route('customers.update', $customer)])
@endsection
