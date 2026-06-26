@extends('layouts.app')
@section('title', 'Add Supplier')
@section('content')
<x-page-header title="Add Supplier" />
@include('suppliers._form', ['action' => route('suppliers.store')])
@endsection
