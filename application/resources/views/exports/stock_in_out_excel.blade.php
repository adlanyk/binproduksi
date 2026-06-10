<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
        td.right { text-align: right; }
    </style>
</head>
<body>
    <h3>
        Laporan Stock In/Out <br>
        Lokasi: {{ $locationText }} <br>
        Periode: {{ $periodText }}
    </h3>

    <table>
        <thead>
            <tr>
                <th>Warehouse</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stock Masuk</th>
                <th>Stock Keluar</th>
                <th>Stock Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $row)
                <tr>
                    <td>{{ $row['warehouse']['name'] ?? '-' }}</td>
                    <td>{{ $row['inventoryitem']['item_code'] ?? '-' }}</td>
                    <td>{{ $row['inventoryitem']['item_name'] ?? '-' }}</td>
                    <td class="right">{{ number_format($row['total_in'], 0, ',', '.') }}</td>
                    <td class="right">{{ $row['display_total_out'] }}</td>
                    <td class="right">{{ number_format($row['total_in'] - $row['total_out'], 0, ',', '.') }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
