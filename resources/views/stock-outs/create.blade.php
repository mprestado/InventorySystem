@extends('layouts.app')
@section('title', 'Record Stock Out')
@section('content')
<x-page-header title="Record Stock Out" subtitle="Deduct stock for sales, damage, returns, etc." />

<form method="POST" action="{{ route('stock-outs.store') }}" x-data="lineItems({{ $variants->toJson() }})">
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
                    <x-field label="Reason" name="reason" type="select" required>
                        @foreach ($reasons as $key => $label)<option value="{{ $key }}">{{ $label }}</option>@endforeach
                    </x-field>
                    <x-field label="Date" name="date" type="date" :value="now()->toDateString()" required />
                    <x-field label="Remarks" name="remarks" type="textarea" />
                </div>
            </x-card>
            <div class="flex flex-col gap-2">
                <x-btn type="submit">Save & Deduct Stock</x-btn>
                <x-btn href="{{ route('stock-outs.index') }}" variant="secondary">Cancel</x-btn>
            </div>
        </div>
    </div>
</form>
@endsection
