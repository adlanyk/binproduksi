<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Stock Opname Report</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 10px; 
            color: #333;
        }
        
        .header { 
            background-color: #f0f0f0;
            padding: 15px; 
            display: flex; 
            align-items: left;
            border-bottom: 2px solid #ccc; 
        }
        .header-content {
            flex-grow: 1; 
            text-align: left;
        }

        .header h1 { 
            font-size: 16px; 
            font-weight: bold;
            margin: 0;
            color: #222;
        }
        .header p {
            font-size: 12px;
            font-weight: normal;
            margin: 0;
            color: #666;
        }

        .report-info {
            margin-top: 20px; 
            margin-bottom: 10px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 5px;
        }
        th, td { 
            border: 1px solid #000000;
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #e0e0e0;
            color: #000000;
            font-weight: bold; 
            text-transform: uppercase; 
        }
        .center-text { text-align: center; }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 9px;
            color: #999;
        }
    </style>
</head>
<body>
   <table width="100%" style="border-collapse: collapse; margin-bottom: 10px;">
    <tr>
        <td style="width: 20%; text-align: left; vertical-align: top; border:none;">
            <img style="height: 60px; width: 100px;" 
                 src="{{ public_path('images/logo.png') }}" alt="Logo">
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
                <th class="center-text">No</th>
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
                <td class="center-text">{{ $index + 1 }}</td>
                <td>{{ $row['item']->item_code ?? '-' }}</td>
                <td>{{ $row['item']->item_name ?? '-' }}</td>
                <td>{{ $row['item']->uom ?? '-' }}</td>
                <td class="center-text" style="color: {{ $row['ending_stock'] == 0 ? 'red' : 'black' }};">
                    {{ number_format($row['ending_stock'], 0, ',', '.') }}
                  </td>
                <td class="center-text"></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
     <table style="border:none; width:100%; margin-top:40px;">
        <tr style="border:none;">
            <td style="border:none; text-align:center;"><strong>
            Staff IT,<br><br><br><br>
            </strong>
                .......................
            </td>
            <td style="border:none; text-align:center;"><strong>
                IT Head,<br><br><br><br>
                 </strong>
                .......................
            </td>
            <td style="border:none; text-align:center;"><strong>
                Verifikator,<br><br><br><br>
            </strong>
                .......................
            </td>
        </tr>
    </table>
</body>
</html>