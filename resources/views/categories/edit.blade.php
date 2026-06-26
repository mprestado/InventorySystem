@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')
<x-page-header title="Edit Category" subtitle="{{ $category->name }}" />
<x-card class="max-w-xl">
    <form method="POST" action="{{ route('categories.update', $category) }}" class="space-y-4">
        @csrf @method('PUT')
        <x-field label="Name" name="name" :value="$category->name" required />
        <x-field label="Parent Category" name="parent_id" type="select">
            <option value="">— None —</option>
            @foreach ($parents as $p)<option value="{{ $p->id }}" @selected(old('parent_id', $category->parent_id)==$p->id)>{{ $p->name }}</option>@endforeach
        </x-field>
        <x-field label="Description" name="description" type="textarea" :value="$category->description" />
        <x-field label="Status" name="status" type="select">
            <option value="active" @selected($category->status=='active')>Active</option>
            <option value="archived" @selected($category->status=='archived')>Archived</option>
        </x-field>
        <div class="flex gap-2 pt-2">
            <x-btn type="submit">Update</x-btn>
            <x-btn href="{{ route('categories.index') }}" variant="secondary">Cancel</x-btn>
        </div>
    </form>
</x-card>
@endsection
