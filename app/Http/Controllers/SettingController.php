<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected array $keys = ['shop_name', 'currency', 'tax_rate', 'address', 'phone', 'email', 'footer_note'];

    public function edit()
    {
        $settings = [];
        foreach ($this->keys as $key) {
            $settings[$key] = Setting::get($key, '');
        }

        return view('settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'currency' => ['required', 'string', 'max:10'],
            'tax_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email'],
            'footer_note' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            Setting::set($key, (string) $value);
        }
        ActivityLogger::log('update', 'Updated shop settings');

        return back()->with('success', 'Settings saved.');
    }
}
