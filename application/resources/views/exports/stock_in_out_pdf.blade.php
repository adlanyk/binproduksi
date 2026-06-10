<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 5px; text-align: center; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h3>{{ $locationText }}<br>
    Report Summary Inventory Barang <br>
         Periode: {{ $periodText }}
    </h3>

    <table>
        <thead>
            <tr>
                <th>No.</th>
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
                        <td>{{ $loop->iteration }}</td>
                        <td class="border px-2 py-1">{{ $row['warehouse']['name'] ?? '-' }}</td>
                        <td>{{ $row['inventoryitem']['item_code'] ?? '-' }}</td>
                        <td>{{ $row['inventoryitem']['item_name'] ?? '-' }}</td>
                        <td>{{ number_format($row['total_in'], 0, ',', '.') }}</td>
                        <td>{{ $row['display_total_out'] }}</td>
                        <td>{{ number_format($row['total_in'] - $row['total_out'], 0, ',', '.') }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <br><br>
    <table style="border:none; width:100%; margin-top:40px;">
        <tr style="border:none;">
            <td style="border:none; text-align:center;">
                Dibuat Oleh,<br><br><br><br>
                .......................
            </td>
            <td style="border:none; text-align:center;">
                Disetujui Oleh,<br><br><br><br>
                .......................
            </td>
        </tr>
    </table>
</body>
</html>
