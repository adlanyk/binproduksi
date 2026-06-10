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
        @foreach($reportData as $label => $block)
            <tr>
                <td colspan="6"><strong>{{ $label }}</strong></td>
            </tr>
            <tr>
                <td colspan="5" style="text-align:right;"><strong>Stock Awal</strong></td>
                <td style="text-align:right;"><strong>{{ number_format($block['opening'] ?? 0, 0, ',', '.') }}</strong></td>
            </tr>
            @foreach($block['rows'] as $row)
                <tr>
                    <td>{{ $row['date'] }}</td>
                    <td>{{ $row['warehouse_name'] ?? '-' }}</td>
                    <td>{{ $row['description'] }}</td>
                    <td style="text-align:right; background:#d4edda;">{{ number_format($row['in'] ?? 0, 0, ',', '.') }}</td>
                     <td style="text-align:right; background:#f8d7da;">
                            {{ $row['out'] > 0 ? '-' . number_format($row['out'], 0, ',', '.') : number_format($row['out'], 0, ',', '.') }}
                    </td>
                    <td style="text-align:right;">{{ number_format($row['balance'] ?? 0, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
