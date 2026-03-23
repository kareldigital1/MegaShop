<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first(); // Charge les paramètres existants
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email|max:255',
            'store_phone' => 'nullable|string|max:20',
            'store_currency' => 'required|string|max:3',
            'store_address' => 'nullable|string|max:255',
            'store_city' => 'nullable|string|max:100',
            'store_zip' => 'nullable|string|max:20',
            'store_country' => 'required|string|max:2',
            'standard_shipping' => 'required|numeric|min:0',
            'express_shipping' => 'required|numeric|min:0',
            'standard_tax' => 'required|numeric|min:0|max:100',
            'reduced_tax' => 'required|numeric|min:0|max:100',
            'include_tax' => 'boolean',
            'credit_card_enabled' => 'boolean',
            'paypal_enabled' => 'boolean',
            'bank_transfer_enabled' => 'boolean',
            'order_confirmation_email' => 'boolean',
            'shipping_confirmation_email' => 'boolean',
            'review_request_email' => 'boolean',
        ]);

        $settings = Setting::first();
        if ($settings) {
            $settings->update($validated);
        } else {
            Setting::create($validated);
        }

        return redirect()->route('admin.settings')->with('success', 'Paramètres mis à jour avec succès.');
    }
}
