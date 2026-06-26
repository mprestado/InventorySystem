@extends('layouts.app')
@section('title', 'Edit Brand')
@section('content')
<x-page-header title="Edit Brand" subtitle="{{ $brand->name }}" />
<x-card class="max-w-xl">
    <form method="POST" action="{{ route('brands.update', $brand) }}" class="space-y-4">
        @csrf @method('PUT')
        <x-field label="Name" name="name" :value="$brand->name" required />
        <x-field label="Description" name="description" type="textarea" :value="$brand->description" />
        <x-field label="Status" name="status" type="select">
            <option value="active" @selected($brand->status=='active')>Active</option>
            <option value="archived" @selected($brand->status=='archived')>Archived</option>
        </x-field>
        <div class="flex gap-2 pt-2"><x-btn type="submit">Update</x-btn><x-btn href="{{ route('brands.index') }}" variant="secondary">Cancel</x-btn></div>
    </form>
</x-card>
@endsection
