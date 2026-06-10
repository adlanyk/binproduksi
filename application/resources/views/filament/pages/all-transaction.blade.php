
<x-filament::page>
    <div class="space-y-6">
        {{ $this->form }}

        @if (!empty($reportData))
            <div class="p-4 bg-white rounded-lg shadow-sm border">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Periode: {{ $periodText }}</h2>
                        <h3 class="text-sm text-gray-500">Lokasi: {{ $locationText }}</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto border-collapse border text-sm">
                        <thead class="bg-gray-100">
                            <tr class="text-left text-gray-700">
                                <th class="border px-3 py-2">No</th>
                                <th class="border px-3 py-2">Tanggal</th>
                                <th class="border px-3 py-2">No Transaksi</th>
                                <th class="border px-3 py-2">Tipe Transaksi</th>
                                <th class="border px-3 py-2">Kode Barang</th>
                                <th class="border px-3 py-2">Warehouse</th>
                                <th class="border px-3 py-2 text-right">Qty</th>
                                <th class="border px-3 py-2">Diterima Oleh</th>
                                <th class="border px-3 py-2">Diserahkan Oleh</th>
                                <th class="border px-3 py-2">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportData as $row)
                                @php
                                    $isOut = $row['transaction_type'] === 'out' || $row['qty'] < 0;
                                  $qtyDisplay = $isOut 
    ? '-' . number_format(abs($row['qty']), 0, ',', '.') 
    : number_format($row['qty'], 0, ',', '.');
                                    $operation = $row['operation'] ?? ($isOut ? 'OUT' : 'IN');
                                @endphp
                                
                                <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                    <td class="border px-3 py-2 text-center">{{ $loop->iteration }}</td>
                                    <td class="border px-3 py-2 text-center">{{ $row['date'] }}</td>
                                    <td class="border px-3 py-2 text-center">{{ $row['transaction_no'] }}</td>
                                    <td class="border px-3 py-2 text-center font-bold {{ $isOut ? 'text-red-600' : 'text-green-600' }}">
                                        {{ strtoupper($row['transaction_type'] ?? ($isOut ? 'OUT' : 'IN')) }}
                                    </td>
                                    <td class="border px-3 py-2">{{ $row['item'] }}</td>
                                    <td class="border px-3 py-2">{{ $row['warehouse'] }}</td>
                                    <td class="border px-3 py-2 text-right font-bold {{ $isOut ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $qtyDisplay }}
                                    </td>
                                    <td class="border px-3 py-2">{{ $row['diterima_oleh'] }}</td>
                                    <td class="border px-3 py-2">{{ $row['diserahkan_oleh'] }}</td>
                                    <td class="border px-3 py-2">{{ $row['notes'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

    <style>
        .text-red-600 { color: #dc2626 !important; }
        .text-green-600 { color: #16a34a !important; }
        .font-bold { font-weight: 600 !important; }
    </style>
</x-filament::page>

