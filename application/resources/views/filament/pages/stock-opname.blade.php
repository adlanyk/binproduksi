<x-filament::page>
    {{ $this->form }}
    
     @if($periodText)
    <div class="space-y-6">
<div class="shadow rounded-xl p-4 bg-white text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors">
            <h2 class="text-lg text-gray-800 font-bold mb-4">Laporan Stock Opname</h2>
            <p class="text-gray-800 dark:text-gray-600 font-bold">
Lokasi/Tempat Penyimpanan : {{ $this->warehouseName }}</p>
            <p style="text-gray-600 font-bold margin: 2px 0;">Tanggal : {{ $periodText }}</p>

            <table class="w-full border-collapse text-sm">
                            <thead class="bg-white dark:bg-gray-800">
                    <tr>
                        <th class="border px-2 py-1 text-center">No</th>
                        <th class="border px-2 py-1">Kode Barang</th>
                        <th class="border px-2 py-1">Nama</th>
                        <th class="border px-2 py-1">Satuan</th>
                        <th class="border px-2 py-1 text-center">Stock Sistem</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($results as $index => $row)
                        <tr>
                            <td class="border px-2 py-1 text-center">{{ $index + 1 }}</td>
                            <td class="border px-2 py-1">{{ $row['item']->item_code }}</td>
                            <td class="border px-2 py-1">{{ $row['item']->item_name }}</td>
                            <td class="border px-2 py-1">{{ $row['item']->uom }}</td>
                            <td class="border px-2 py-1 text-center {{ $row['ending_stock'] == 0 ? 'text-red-600' : '' }}">
                                    {{ number_format($row['ending_stock'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</x-filament::page>
