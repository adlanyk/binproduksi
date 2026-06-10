<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bin;
use App\Models\BinItem;

class BinSeeder extends Seeder
{
    public function run(): void
    {
        // ========== 1. BUAT BIN ==========

        // Bin Grinding: B1 s/d B8 (8 bin)
        for ($i = 1; $i <= 8; $i++) {
            Bin::create([
                'code' => "B{$i}",
                'name' => "Bin Grinding {$i}",
                'type' => 'grinding',
            ]);
        }

        // Bin Pelleting: P1 s/d P6 (6 bin)
        for ($i = 1; $i <= 6; $i++) {
            Bin::create([
                'code' => "P{$i}",
                'name' => "Bin Pelleting {$i}",
                'type' => 'pelleting',
            ]);
        }

        // Bin Dosing: D1 s/d D25 (25 bin)
        for ($i = 1; $i <= 25; $i++) {
            Bin::create([
                'code' => "D{$i}",
                'name' => "Bin Dosing {$i}",
                'type' => 'dosing',
            ]);
        }

        // Bin Makro: D26 s/d D31 (6 bin)
        for ($i = 26; $i <= 31; $i++) {
            Bin::create([
                'code' => "D{$i}",
                'name' => "Bin Makro {$i}",
                'type' => 'makro',
            ]);
        }

        // Bin Bagging: F1 s/d F12 (12 bin)
        for ($i = 1; $i <= 12; $i++) {
            Bin::create([
                'code' => "F{$i}",
                'name' => "Bin Bagging {$i}",
                'type' => 'bagging',
            ]);
        }

        // ========== 2. TAMBAHKAN DATA CONTOH ITEM (DUMMY) ==========
        // Supaya tidak terlihat kosong saat pertama kali dilihat

        $sampleItems = [
            'B1' => ['item_name' => 'Jagung Giling', 'item_code' => 'JG-001', 'quantity' => 2500, 'unit' => 'kg'],
            'B2' => ['item_name' => 'Kedelai', 'item_code' => 'KD-002', 'quantity' => 1800, 'unit' => 'kg'],
            'B3' => ['item_name' => 'Dedak Halus', 'item_code' => 'DH-003', 'quantity' => 3200, 'unit' => 'kg'],
            'B4' => ['item_name' => 'Tepung Ikan', 'item_code' => 'TI-004', 'quantity' => 1500, 'unit' => 'kg'],
            'P1' => ['item_name' => 'Pakan Pelet A', 'item_code' => 'PP-A01', 'quantity' => 5000, 'unit' => 'kg'],
            'P2' => ['item_name' => 'Pakan Pelet B', 'item_code' => 'PP-B02', 'quantity' => 4500, 'unit' => 'kg'],
            'D1' => ['item_name' => 'Konsentrat A', 'item_code' => 'KA-001', 'quantity' => 800, 'unit' => 'kg'],
            'D2' => ['item_name' => 'Vitamin Mix', 'item_code' => 'VM-002', 'quantity' => 200, 'unit' => 'kg'],
            'D26' => ['item_name' => 'Premix Makro', 'item_code' => 'PM-001', 'quantity' => 500, 'unit' => 'kg'],
            'F1' => ['item_name' => 'Pakan Jadi', 'item_code' => 'PJ-001', 'quantity' => 1000, 'unit' => 'sak'],
        ];

        foreach ($sampleItems as $binCode => $itemData) {
            $bin = Bin::where('code', $binCode)->first();
            if ($bin) {
                BinItem::create([
                    'bin_id' => $bin->id,
                    'item_name' => $itemData['item_name'],
                    'item_code' => $itemData['item_code'],
                    'quantity' => $itemData['quantity'],
                    'unit' => $itemData['unit'],
                    'notes' => 'Data awal seeding',
                ]);
            }
        }
    }
}
