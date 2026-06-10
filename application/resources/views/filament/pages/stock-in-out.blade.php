<x-filament::page>
    <div class="space-y-6">
        {{ $this->form }}

        @if($periodText)
            <div class="p-4 bg-white rounded-lg shadow-sm border">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="bg-white text-xl font-bold text-gray-600 dark:text-black">Report Stock In / Out</h2>
                        <p class="text-gray-600">Periode: {{ $periodText }} | Lokasi: {{ $locationText }}</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border text-sm">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-gray-700">
                                <th class="border px-3 py-2">No.</th>
                                <th class="border px-3 py-2">Warehouse</th>
                                <th class="border px-3 py-2">Kode Barang</th>
                                <th class="border px-3 py-2">Nama Barang</th>
                                <th class="border px-3 py-2 text-right">Stock Masuk</th>
                                <th class="border px-3 py-2 text-right">Stock Keluar</th>
                                <th class="border px-3 py-2 text-right">Stock Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reportData as $row)
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                                    <td class="border px-3 py-2">{{ $row['warehouse']['name'] ?? '-' }}</td>
                                    <td class="border px-3 py-2">{{ $row['inventoryitem']['item_code'] ?? '-' }}</td>
                                    <td class="border px-3 py-2">{{ $row['inventoryitem']['item_name'] ?? '-' }}</td>
                                    <td class="border px-3 py-2 text-right">{{ number_format($row['total_in'], 0, ',', '.') }}</td>
                                    <td class="border px-3 py-2 text-right">{{ $row['display_total_out'] }}</td>
                                    <td class="border px-3 py-2 text-right {{ ($row['total_in'] - $row['total_out']) < 0 ? 'text-red-600 font-bold' : '' }}">
                                        {{ number_format($row['total_in'] - $row['total_out'], 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-2 text-gray-500">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-filament::page>
