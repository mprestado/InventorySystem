@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<x-page-header title="Edit Product" subtitle="{{ $product->name }}" />
@include('products._form', ['action' => route('products.update', $product)])
@endsection
