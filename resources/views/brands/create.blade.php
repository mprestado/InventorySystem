@extends('layouts.app')
@section('title', 'Add Brand')
@section('content')
<x-page-header title="Add Brand" />
<x-card class="max-w-xl">
    <form method="POST" action="{{ route('brands.store') }}" class="space-y-4">
        @csrf
        <x-field label="Name" name="name" required />
        <x-field label="Description" name="description" type="textarea" />
        <x-field label="Status" name="status" type="select">
            <option value="active">Active</option><option value="archived">Archived</option>
        </x-field>
        <div class="flex gap-2 pt-2"><x-btn type="submit">Save</x-btn><x-btn href="{{ route('brands.index') }}" variant="secondary">Cancel</x-btn></div>
    </form>
</x-card>
@endsection
