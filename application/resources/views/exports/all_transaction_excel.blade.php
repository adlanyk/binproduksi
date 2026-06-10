<table>
    <thead>
        <tr>
            <th colspan="10" style="text-align: left; font-weight: bold;">
                Laporan Semua Transaksi
            </th>
        </tr>
        <tr>
            <td colspan="10"><strong>Lokasi:</strong> {{ $locationText }}</td>
        </tr>
        <tr>
            <td colspan="10"><strong>Periode:</strong> {{ $periodText }}</td>
        </tr>
        <tr></tr>
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
            <tr>
                <td >{{ $loop->iteration }}</td>
                <td >{{ $row['date'] ?? '-' }}</td>
                <td >{{ $row['transaction_no'] ?? '-'  }}</td>
                <td >{{ ucfirst($row['operation'] ?? '-') }}</td>
                <td>{{ $row['item'] ?? '-' }}</td>
                <td>{{ $row['warehouse'] ?? '-' }}</td>
                <td>{{ number_format($row['qty'] ?? 0, 0, ',', '.') }}</td>
                <td>{{ $row['diterima_oleh'] ?? '-' }}</td>
                <td>{{ $row['diserahkan_oleh'] ?? '-' }}</td>
                <td>{{ $row['notes'] ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="10" style="text-align: center;">Tidak ada data transaksi</td>
            </tr>
        @endforelse
    </tbody>
</table>
