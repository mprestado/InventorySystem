@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<x-page-header title="Edit User" subtitle="{{ $user->name }}" />
@include('users._form', ['action' => route('users.update', $user)])
@endsection
