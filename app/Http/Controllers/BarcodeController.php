<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BarcodeController extends Controller
{
    public function barcode(string $code)
    {
        $generator = new \Milon\Barcode\DNS1D;
        $png = base64_decode($generator->getBarcodePNG($code, 'C128', 2, 60));

        return response($png)->header('Content-Type', 'image/png');
    }

    public function qrcode(string $code)
    {
        $svg = QrCode::format('svg')->size(180)->margin(1)->generate($code);

        return response($svg)->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Resolve a variant by barcode/SKU/id — used by the POS scanner and stock lookups.
     */
    public function lookup(Request $request)
    {
        $query = ProductVariant::with('product');

        if ($request->filled('id')) {
            $variant = $query->find($request->id);
        } else {
            $code = trim((string) $request->get('code', ''));
            $variant = $query->where('barcode', $code)->orWhere('sku', $code)->first();
        }

        if (! $variant) {
            return $request->wantsJson()
                ? response()->json(['found' => false], 404)
                : redirect()->route('dashboard')->with('error', 'No product matches that code.');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'found' => true,
                'id' => $variant->id,
                'label' => $variant->display_name,
                'price' => (float) ($variant->selling_price ?: $variant->product->selling_price),
                'stock' => $variant->stock_quantity,
            ]);
        }

        return redirect()->route('products.show', $variant->product_id);
    }
}
