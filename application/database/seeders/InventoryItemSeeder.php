<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InventoryItem;

class InventoryItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InventoryItem::create([
            'location_id' => '1',
            'warehouse_id' => '1',
            'item_code' => 'GS03050052',
            'item_name' => 'TINTA EPSON MERAH',
            'quantity' => '0',
            'uom' => 'PCS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        InventoryItem::create([
            'location_id' => '1',
            'warehouse_id' => '1',
            'item_code' => 'GS03050050',
            'item_name' => 'TINTA EPSON HITAM',
            'quantity' => '0',
            'uom' => 'PCS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        InventoryItem::create([
            'location_id' => '1',
            'warehouse_id' => '1',
            'item_code' => 'GS03050051',
            'item_name' => 'TINTA EPSON BIRU',
            'quantity' => '0',
            'uom' => 'PCS',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
