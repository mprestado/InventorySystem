<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Receipt · {{ $sale->invoice_number }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@media print { .no-print{display:none} @page{margin:0} body{margin:0} }</style>
</head>
<body class="bg-slate-100 font-sans p-6">
    <div class="no-print max-w-sm mx-auto mb-4 flex gap-2">
        <button onclick="window.print()" class="flex-1 py-2.5 rounded-lg bg-indigo-600 text-white text-sm font-semibold">🖨 Print Receipt</button>
        <a href="{{ route('pos') }}" class="flex-1 py-2.5 rounded-lg bg-white border text-sm font-semibold text-center">New Sale</a>
        <a href="{{ route('sales.index') }}" class="py-2.5 px-4 rounded-lg bg-white border text-sm font-semibold text-center">Sales</a>
    </div>
    <div class="max-w-sm mx-auto bg-white p-6 text-sm text-slate-800" style="font-family: 'Courier New', monospace;">
        <div class="text-center mb-4">
            <h1 class="text-lg font-bold">{{ $shop }}</h1>
            @if($address)<p class="text-xs">{{ $address }}</p>@endif
            @if($phone)<p class="text-xs">{{ $phone }}</p>@endif
        </div>
        <div class="border-y border-dashed border-slate-400 py-2 text-xs">
            <div class="flex justify-between"><span>Invoice:</span><span>{{ $sale->invoice_number }}</span></div>
            <div class="flex justify-between"><span>Date:</span><span>{{ $sale->sale_date->format('M d, Y H:i') }}</span></div>
            <div class="flex justify-between"><span>Cashier:</span><span>{{ $sale->cashier?->name ?? '—' }}</span></div>
            <div class="flex justify-between"><span>Customer:</span><span>{{ $sale->customer?->name ?? 'Walk-in' }}</span></div>
        </div>
        <table class="w-full my-2 text-xs">
            @foreach ($sale->items as $item)
                <tr><td class="py-0.5">{{ $item->quantity }}x {{ $item->variant?->display_name }}</td>
                    <td class="py-0.5 text-right">{{ $currency }}{{ number_format($item->total, 2) }}</td></tr>
            @endforeach
        </table>
        <div class="border-t border-dashed border-slate-400 pt-2 text-xs space-y-0.5">
            <div class="flex justify-between"><span>Subtotal</span><span>{{ $currency }}{{ number_format($sale->subtotal, 2) }}</span></div>
            <div class="flex justify-between"><span>Tax</span><span>{{ $currency }}{{ number_format($sale->tax, 2) }}</span></div>
            <div class="flex justify-between"><span>Discount</span><span>-{{ $currency }}{{ number_format($sale->discount, 2) }}</span></div>
            <div class="flex justify-between font-bold text-sm border-t border-slate-300 pt-1 mt-1"><span>TOTAL</span><span>{{ $currency }}{{ number_format($sale->total, 2) }}</span></div>
            <div class="flex justify-between"><span>Paid ({{ ucfirst($sale->payment_method) }})</span><span>{{ $currency }}{{ number_format($sale->amount_paid, 2) }}</span></div>
            <div class="flex justify-between"><span>Change</span><span>{{ $currency }}{{ number_format($sale->change_due, 2) }}</span></div>
        </div>
        <p class="text-center text-xs mt-4">{{ setting('footer_note', 'Thank you for shopping with us!') }}</p>
    </div>
    <script>window.addEventListener('load', () => { /* auto-focus print */ });</script>
</body>
</html>
