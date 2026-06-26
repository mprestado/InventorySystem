@extends('layouts.app')
@section('title', 'Add Customer')
@section('content')
<x-page-header title="Add Customer" />
@include('customers._form', ['action' => route('customers.store')])
@endsection
