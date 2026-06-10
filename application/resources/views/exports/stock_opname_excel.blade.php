<table width="100%" style="border-collapse: collapse; margin-bottom: 10px;">
    <tr>
        <td style="width: 5%; text-align: left; vertical-align: top; border:none;">
           <img src="{{ public_path('images/logo.png') }}" style="height:60px; width:auto;" alt="Logo">
        </td>
        <td style="width: 80%; text-align: left; vertical-align: middle; border: none;">
            <h2 style="margin: 0; padding: 0;">STOCK OPNAME IT</h2>
            <p style="margin: 2px 0;"><strong>Lokasi/Tempat Penyimpanan : {{ $warehouse }}</strong></p>
            <p style="margin: 2px 0;"><strong>Tanggal : {{ $periodText }}</strong></p>
        </td>
    </tr>
</table>


<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama</th>
            <th>Satuan</th>
            <th>Stok Sistem</th>
            <th>Stok Fisik</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($results as $index => $row)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $row['item']->item_code }}</td>
            <td>{{ $row['item']->item_name }}</td>
            <td>{{ $row['item']->uom }}</td>
           <td>{{ number_format($row['ending_stock'], 0, ',', '.') }}</td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
