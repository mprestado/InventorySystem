@extends('layouts.app')
@section('title', 'Add Category')
@section('content')
<x-page-header title="Add Category" />
<x-card class="max-w-xl">
    <form method="POST" action="{{ route('categories.store') }}" class="space-y-4">
        @csrf
        <x-field label="Name" name="name" required />
        <x-field label="Parent Category" name="parent_id" type="select">
            <option value="">— None —</option>
            @foreach ($parents as $p)<option value="{{ $p->id }}" @selected(old('parent_id')==$p->id)>{{ $p->name }}</option>@endforeach
        </x-field>
        <x-field label="Description" name="description" type="textarea" />
        <x-field label="Status" name="status" type="select">
            <option value="active">Active</option><option value="archived">Archived</option>
        </x-field>
        <div class="flex gap-2 pt-2">
            <x-btn type="submit">Save</x-btn>
            <x-btn href="{{ route('categories.index') }}" variant="secondary">Cancel</x-btn>
        </div>
    </form>
</x-card>
@endsection
