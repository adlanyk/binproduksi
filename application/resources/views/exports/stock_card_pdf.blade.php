<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Stok</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 4px; text-align: left; }
        th { background: #f0f0f0; }
        td.right { text-align: right; }
        td.in { background-color: #d4edda; }
        td.out { background-color: #f8d7da; }
    </style>
</head>
<body>
    <h3><strong> Lokasi: {{ $locationText }} <br>
    Stock Card Barang <br>
    Periode: {{ $periodText }}</strong></h3>
    @foreach($reportData as $label => $block)
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Warehouse</th>
                    <th>Keterangan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Stock Akhir</th>
                </tr>
            </thead>
            <tbody>
                  <tr>
                    <td colspan="6"><strong>{{ $label }}</strong></td>
                </tr>
                 <tr>
                    <td style="text-align: right;" colspan="5"><strong>Stock Awal</strong></td>
                        <td class="right"><strong>{{ number_format($block['opening']) }}</strong></td>
                </tr>
                @foreach($block['rows'] as $row)
                    <tr>
                        <td>{{ $row['date'] }}</td>
                        <td>{{ $row['warehouse_name'] ?? '-' }}</td>
                        <td>{{ $row['description'] }}</td>
                        <td class="right in" style="text-align:right">{{ number_format($row['in'], 0, ',', '.') }}</td>                        
                        <td class="right out">
                            {{ $row['out'] > 0 ? '-' . number_format($row['out'], 0, ',', '.') : number_format($row['out'], 0, ',', '.') }}
                        </td>
                        <td style="text-align:right">{{ number_format($row['balance'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
