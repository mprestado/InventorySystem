@extends('layouts.app')
@section('title', 'Add Product')
@section('content')
<x-page-header title="Add Product" subtitle="Create a new product with optional variants" />
@include('products._form', ['action' => route('products.store')])
@endsection
