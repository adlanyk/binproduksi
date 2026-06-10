<?php

namespace App\Http\Controllers;

use App\Models\Bin;
use App\Models\BinItem;
use Illuminate\Http\Request;

class BinController extends Controller
{
    public function index()
    {
        // Pastikan eager loading items
        $bins = Bin::with('items')->get();

        $grouped = [
            'grinding' => $bins->where('type', 'grinding'),
            'pelleting' => $bins->where('type', 'pelleting'),
            'dosing' => $bins->where('type', 'dosing'),
            'makro' => $bins->where('type', 'makro'),
            'bagging' => $bins->where('type', 'bagging'),
        ];

        // Debug: cek data
        // \Log::info('Bins count: ' . $bins->count());
        // \Log::info('First bin items: ' . $bins->first()->items);

        return view('bins.index', compact('grouped'));
    }

    public function updateItem(Request $request, Bin $bin)
    {
        $request->validate([
            'item_name' => 'required|string|max:255',
            'item_code' => 'nullable|string|max:50',
            'quantity' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
        ]);

        $item = BinItem::create([
            'bin_id' => $bin->id,
            'item_name' => $request->item_name,
            'item_code' => $request->item_code,
            'quantity' => $request->quantity ?? 0,
            'unit' => $request->unit ?? 'kg',
            'notes' => $request->notes,
        ]);

        // Debug: cek apakah tersimpan
        // \Log::info('Item created: ' . $item->id . ' - ' . $item->item_name);

        return redirect()->back()->with('success', "✅ {$bin->code} berisi: {$request->item_name}");
    }

    public function clearItem(Bin $bin)
    {
        BinItem::create([
            'bin_id' => $bin->id,
            'item_name' => 'Kosong',
            'item_code' => null,
            'quantity' => 0,
            'notes' => 'Bin dalam keadaan kosong',
        ]);

        return redirect()->back()->with('success', "🗑️ {$bin->code} telah dikosongkan");
    }
}
