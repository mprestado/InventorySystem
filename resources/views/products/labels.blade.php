<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Labels · {{ $product->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>@media print { .no-print { display:none } @page { margin: 1cm } }</style>
</head>
<body class="bg-slate-100 p-6 font-sans">
    <div class="no-print max-w-4xl mx-auto mb-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Labels — {{ $product->name }}</h1>
        <div class="flex gap-2">
            <button onclick="window.print()" class="px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-semibold">Print</button>
            <a href="{{ route('products.show', $product) }}" class="px-4 py-2 rounded-lg bg-white border text-sm font-semibold">Back</a>
        </div>
    </div>
    <div class="max-w-4xl mx-auto grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach ($product->variants as $v)
            <div class="bg-white border rounded-lg p-3 text-center break-inside-avoid">
                <p class="font-bold text-sm truncate">{{ $product->name }}</p>
                <p class="text-xs text-slate-500">{{ $v->name }}</p>
                <p class="text-lg font-extrabold my-1">{{ setting('currency','₱') }}{{ number_format($v->selling_price, 2) }}</p>
                <img src="{{ route('barcode.generate', $v->barcode) }}" class="h-12 mx-auto" alt="">
                <p class="text-[10px] font-mono mt-1">{{ $v->barcode }}</p>
                <p class="text-[10px] text-slate-400">{{ $v->sku }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
