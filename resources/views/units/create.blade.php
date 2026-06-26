@extends('layouts.app')
@section('title', 'Add Unit')
@section('content')
<x-page-header title="Add Unit" />
<x-card class="max-w-md">
    <form method="POST" action="{{ route('units.store') }}" class="space-y-4">
        @csrf
        <x-field label="Name" name="name" required placeholder="e.g. Piece" />
        <x-field label="Abbreviation" name="abbreviation" required placeholder="e.g. pc" />
        <div class="flex gap-2 pt-2"><x-btn type="submit">Save</x-btn><x-btn href="{{ route('units.index') }}" variant="secondary">Cancel</x-btn></div>
    </form>
</x-card>
@endsection
