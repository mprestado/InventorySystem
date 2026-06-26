@extends('layouts.app')
@section('title', 'New Adjustment')
@section('content')
<x-page-header title="New Inventory Adjustment" subtitle="Quantity = amount to add/remove, or the corrected count for 'Correct Stock'" />

<form method="POST" action="{{ route('adjustments.store') }}" x-data="lineItems({{ $variants->toJson() }})">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2">
            <x-card>
                <h3 class="font-bold mb-4">Items</h3>
                @include('partials.line-item-picker', ['withCost' => false])
            </x-card>
        </div>
        <div class="space-y-5">
            <x-card>
                <h3 class="font-bold mb-4">Details</h3>
                <div class="space-y-4">
                    <x-field label="Type" name="type" type="select" required>
                        @foreach ($types as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach
                    </x-field>
                    <x-field label="Reason" name="reason" required placeholder="e.g. Stock count correction" />
                    <x-field label="Date" name="date" type="date" :value="now()->toDateString()" required />
                    <x-field label="Remarks" name="remarks" type="textarea" />
                </div>
            </x-card>
            <div class="flex flex-col gap-2">
                <x-btn type="submit">Apply Adjustment</x-btn>
                <x-btn href="{{ route('adjustments.index') }}" variant="secondary">Cancel</x-btn>
            </div>
        </div>
    </div>
</form>
@endsection
