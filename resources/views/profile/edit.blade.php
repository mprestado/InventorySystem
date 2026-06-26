@extends('layouts.app')
@section('title', 'My Profile')
@section('content')
<x-page-header title="My Profile" subtitle="Manage your account details" />
<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    <x-card>
        <div class="text-center">
            <img src="{{ $user->avatar_url }}" class="w-24 h-24 rounded-full object-cover mx-auto mb-3">
            <h3 class="font-bold text-lg">{{ $user->name }}</h3>
            <p class="text-sm text-slate-400">{{ $user->email }}</p>
            <x-badge color="purple" class="mt-2">{{ $user->role_name }}</x-badge>
        </div>
    </x-card>
    <x-card class="lg:col-span-2">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-field label="Name" name="name" :value="$user->name" required />
                <x-field label="Email" name="email" type="email" :value="$user->email" required />
                <x-field label="Phone" name="phone" :value="$user->phone" />
                <x-field label="Avatar" name="avatar" type="file" />
                <x-field label="New Password" name="password" type="password" />
                <x-field label="Confirm Password" name="password_confirmation" type="password" />
            </div>
            <x-btn type="submit">Save Changes</x-btn>
        </form>
    </x-card>
</div>
@endsection
