<!DOCTYPE html>
<html>

<head>
    <title>Laporan Penerimaan Barang</title>
    <style>
        /* CSS untuk styling laporan */
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Tambahkan styling lain sesuai kebutuhan */
    </style>
</head>

<body>

    <h1>Laporan Penerimaan Barang</h1>
    <h3 style="text-align: center">Data per {{ date('d F Y') }}</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Penerimaan</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Satuan Barang</th>
                <th>Tanggal Penerimaan</th>
            </tr>
        </thead>
        <tbody>
            {{-- Lakukan perulangan untuk menampilkan data barang --}}
            @foreach ($dataPenerimaan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->id_penerimaan }}</td>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ $item->jumlah }}</td>
                    <td>{{ $item->satuan_barang }}</td>
                    <td>{{ $item->tanggal_penerimaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
