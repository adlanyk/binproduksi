<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Semua Transaksi</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            font-size: 11px; 
            line-height: 1.4; 
        }
        h2 { margin-bottom: 0; }
        p { margin: 2px 0; }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            table-layout: fixed; 
        }
        th, td { 
            border: 1px solid #444; 
            padding: 5px 6px; 
             word-wrap: break-word;
    overflow-wrap: break-word;
        }
        th { 
            background: #f2f2f2; 
            font-weight: bold; 
            text-align: center; 
        }
        tbody tr:nth-child(even) {
            background: #fafafa;
        }
        td { vertical-align: top; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; } 

               th:nth-child(1), td:nth-child(1) { width: 5%;  }
    </style>
</head>
<body>
    <p><strong>Lokasi:</strong> {{ $locationText }}</p>
    <p><strong> Transaksi Per Inventory Barang</strong></p>
    <p><strong>Tanggal:</strong> {{ $periodText }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Transaksi</th>
                <th>Tipe</th>
                <th>Kode - Nama Barang</th>
                <th>Warehouse</th>
                <th>Qty</th>
                <th>Diterima Oleh</th>
                <th>Diserahkan Oleh</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reportData as $row)
                   @php
                    $isOut = $row['transaction_type'] === 'out' || $row['qty'] < 0;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $row['date'] ?? '-' }}</td>
                    <td class="text-center">{{ $row['transaction_no'] ?? '-'  }}</td>
                     <td class="text-center {{ $isOut ? 'text-red' : 'text-green' }}">
                        {{ strtoupper($row['transaction_type'] ?? '-') }}
                    </td>
                    <td class="text-left">{{ $row['item'] ?? '-' }}</td>
                    <td class="text-left">{{ $row['warehouse'] ?? '-' }}</td>
                      <td class="text-right {{ $isOut ? 'text-red' : 'text-green' }}">
                       {{ number_format($row['qty'], 0, ',', '.') }}
                    </td>
                    <td class="text-left">{{ $row['diterima_oleh'] ?? '-' }}</td>
                    <td class="text-left">{{ $row['diserahkan_oleh'] ?? '-' }}</td>
                    <td class="text-left">{{ $row['notes'] ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
