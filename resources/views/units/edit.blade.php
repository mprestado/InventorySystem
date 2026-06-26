@extends('layouts.app')
@section('title', 'Edit Unit')
@section('content')
<x-page-header title="Edit Unit" subtitle="{{ $unit->name }}" />
<x-card class="max-w-md">
    <form method="POST" action="{{ route('units.update', $unit) }}" class="space-y-4">
        @csrf @method('PUT')
        <x-field label="Name" name="name" :value="$unit->name" required />
        <x-field label="Abbreviation" name="abbreviation" :value="$unit->abbreviation" required />
        <div class="flex gap-2 pt-2"><x-btn type="submit">Update</x-btn><x-btn href="{{ route('units.index') }}" variant="secondary">Cancel</x-btn></div>
    </form>
</x-card>
@endsection
