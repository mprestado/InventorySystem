@extends('layouts.app')
@section('title', 'Add User')
@section('content')
<x-page-header title="Add User" />
@include('users._form', ['action' => route('users.store')])
@endsection
