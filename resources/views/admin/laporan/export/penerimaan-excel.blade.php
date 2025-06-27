<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penerimaan Barang</title>
    <style>
        body {
            font-family: 'Calibri', sans-serif;
        }

        h1 {
            font-size: 26pt;
            /* Point size for Excel */
            font-weight: bold;
            color: #1a5276;
            /* A nice dark blue color */
            margin: 0;
        }

        h3 {
            font-size: 14pt;
            color: #566573;
            margin-top: 5px;
            margin-bottom: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11pt;
        }

        thead th {
            background-color: #d6eaf8;
            /* Light blue background for header */
            color: #1a5276;
            font-weight: bold;
            text-align: center;
            padding: 10px;
            border: 1px solid #aed6f1;
            /* Lighter blue border */
        }

        tbody td {
            padding: 8px;
            border: 1px solid #e5e8e8;
            /* Light gray border */
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9f9;
            /* Light gray for even rows */
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="6" style="text-align: center; font-weight: 600; fontsize: 1.8rem;">
                    <h1>Laporan Data Penerimaan Barang</h1>
                </th>
            </tr>
            <tr>
                <th colspan="6" style="text-align: center; font-weight: 500; fontsize: 1.2rem">
                    <h3>Data per {{ \Carbon\Carbon::now()->format('d F Y') }}</h3>
                </th>
            </tr>
            <tr></tr>
            <tr>
                <th class="text-center">No</th>
                <th>ID Penerimaan</th>
                <th>Nama Barang</th>
                <th class="text-center">Jumlah Barang</th>
                <th>Satuan Barang</th>
                <th>Tanggal Penerimaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPenerimaan as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->id_penerimaan }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td class="text-right">{{ $item->jumlah }}</td>
                    <td>{{ $item->satuan_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal_penerimaan)->format('d F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
