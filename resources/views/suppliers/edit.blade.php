@extends('layouts.app')
@section('title', 'Edit Supplier')
@section('content')
<x-page-header title="Edit Supplier" subtitle="{{ $supplier->name }}" />
@include('suppliers._form', ['action' => route('suppliers.update', $supplier)])
@endsection
