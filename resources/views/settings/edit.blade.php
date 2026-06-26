@extends('layouts.app')
@section('title', 'Settings')
@section('content')
<x-page-header title="Shop Settings" subtitle="Business information used on receipts and reports" />
<x-card class="max-w-2xl">
    <form method="POST" action="{{ route('settings.update') }}" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @csrf @method('PUT')
        <x-field class="sm:col-span-2" label="Shop Name" name="shop_name" :value="$settings['shop_name']" required />
        <x-field label="Currency Symbol" name="currency" :value="$settings['currency']" required />
        <x-field label="Tax Rate (%)" name="tax_rate" type="number" :value="$settings['tax_rate']" required />
        <x-field label="Phone" name="phone" :value="$settings['phone']" />
        <x-field label="Email" name="email" type="email" :value="$settings['email']" />
        <x-field class="sm:col-span-2" label="Address" name="address" type="textarea" :value="$settings['address']" />
        <x-field class="sm:col-span-2" label="Receipt Footer Note" name="footer_note" :value="$settings['footer_note']" placeholder="e.g. Thank you for shopping with us!" />
        <div class="sm:col-span-2"><x-btn type="submit">Save Settings</x-btn></div>
    </form>
</x-card>
@endsection
