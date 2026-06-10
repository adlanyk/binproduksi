<x-filament-panels::page>
    {{ $this->form }}

    @if(!empty($reportData))
        <div class="mt-6 space-y-8">
            <div class="text-sm text-gray-600 flex items-center gap-4">
                <span class="bg-gray-100 px-3 py-1 rounded-full shadow-sm">
                    📅 Periode: <strong>{{ $periodText }}</strong>
                </span>
                <span class="bg-gray-100 px-3 py-1 rounded-full shadow-sm">
                    📍 Lokasi: <strong>{{ $locationText }}</strong>
                </span>
            </div>

            @foreach($reportData as $label => $block)
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    <div class="p-4 bg-gray-50 flex justify-between items-center">
<h2 class="bg-white dark:bg-gray-800 text-black dark:text-black p-2 rounded">

                        <!-- <h2 class="text-lg font-bold text-gray-800"> -->
                            {{ $label }}
                        </h2>
                        <div class="text-sm text-gray-600">
                            💰 Saldo awal: <strong class="text-blue-600">{{ number_format($block['opening'], 0, ',', '.') }}</strong> &middot;
                            💰 Saldo akhir: <strong class="text-green-600">{{ number_format($block['closing'], 0, ',', '.') }}</strong>                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse text-sm">
                            <thead class="bg-white dark:bg-gray-800">
                            <!-- <thead class="bg-gray-100 sticky top-0"> -->
                                <tr>
                                    <th class="border px-3 py-2 text-left">No.</th>
                                    <th class="border px-3 py-2 text-left">Tanggal</th>
                                    <th class="border px-3 py-2">Warehouse</th>
                                    <th class="border px-3 py-2 text-left">Keterangan</th>
                                    <th class="border px-3 py-2 text-right">Stock Masuk</th>
                                    <th class="border px-3 py-2 text-right">Stock Keluar</th>
                                    <th class="border px-3 py-2 text-right">Stock Akhir</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($block['rows'] as $row)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="border px-3 py-2">{{ $loop->iteration }}</td>
                                        <td class="border px-3 py-2">{{ $row['date'] }}</td>
                                        <td class="border px-3 py-2 font-medium text-gray-700">{{ $row['warehouse_name'] ?? '-' }}</td>
                                        <td class="border px-3 py-2 text-gray-600">{{ $row['description'] }}</td>
                                        <td class="border px-3 py-2 text-right text-green-600 font-semibold">
                                            {{ number_format($row['in'], 0, ',', '.') }}
                                        </td>
                                        <td class="border px-3 py-2 text-right">
                                               {{ $row['out'] > 0 ? '-' . number_format($row['out'], 0, ',', '.') : number_format($row['out'], 0, ',', '.') }}
                                         </td>
                                  
                                        <td class="border px-3 py-2 text-right font-bold">
                                             {{ number_format($row['balance'], 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-filament-panels::page>
